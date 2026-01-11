<?php
namespace App\Libraries;

//$format = new \App\Libraries\MyFormat($data, 'json');
/**
 * Format class
 * Help convert between various formats such as XML, JSON, CSV, etc.
 *
 * @author    Phil Sturgeon, Chris Kacerguis, @softwarespot
 * @license   http://www.dbad-license.org/
 */
class Format {

    /**
     * Array output format
     */
    const ARRAY_FORMAT = 'array';

    /**
     * Comma Separated Value (CSV) output format
     */
    const CSV_FORMAT = 'csv';

    /**
     * Json output format
     */
    const JSON_FORMAT = 'json';

    /**
     * HTML output format
     */
    const HTML_FORMAT = 'html';

    /**
     * PHP output format
     */
    const PHP_FORMAT = 'php';

    /**
     * Serialized output format
     */
    const SERIALIZED_FORMAT = 'serialized';

    /**
     * XML output format
     */
    const XML_FORMAT = 'xml';

    /**
     * Default format of this class
     */
    const DEFAULT_FORMAT = self::JSON_FORMAT; // Couldn't be DEFAULT, as this is a keyword

    /**
     * Data to parse
     *
     * @var mixed
     */
    protected $_data = [];

    /**
     * Type to convert from
     *
     * @var string
     */
    protected $_from_type = NULL;

    /**
     * DO NOT CALL THIS DIRECTLY, USE factory()
     *
     * @param NULL $data
     * @param NULL $from_type
     * @throws \Exception
     */

    public function __construct($data = NULL, $from_type = NULL)
    {
        // Load the inflector helper (CI4 style)
        helper('inflector');

        // If the provided data is already formatted, convert it
        if ($fromType !== null) {
            $method = '_from_' . $fromType;

            if (method_exists($this, $method)) {
                $data = $this->{$method}($data);
            } else {
                throw new \Exception('Format class does not support conversion from "' . $fromType . '".');
            }
        }

        // Store the data
        $this->data = $data;
    }

    /**
     * Create an instance of the format class
     * e.g: echo $this->format->factory(['foo' => 'bar'])->to_csv();
     *
     * @param mixed $data Data to convert/parse
     * @param string $from_type Type to convert from e.g. json, csv, html
     *
     * @return object Instance of the format class
     */
    public function factory($data, $from_type = NULL)
    {
        // $class = __CLASS__;
        // return new $class();

        return new static($data, $from_type);
    }

    // FORMATTING OUTPUT ---------------------------------------------------------

    /**
     * Format data as an array
     *
     * @param mixed|NULL $data Optional data to pass, so as to override the data passed
     * to the constructor
     * @return array Data parsed as an array; otherwise, an empty array
     */
    public function toArray($data = null)
    {
        // If no data passed, use the class's stored data
        if ($data === null && func_num_args() === 0) {
            $data = $this->data;
        }

        // Ensure data is an array
        if (!is_array($data)) {
            $data = (array) $data;
        }

        $array = [];
        foreach ($data as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $array[$key] = $this->toArray($value); // recursive call
            } else {
                $array[$key] = $value;
            }
        }

        return $array;
    }

    /**
     * Format data as XML
     *
     * @param mixed|NULL $data Optional data to pass, so as to override the data passed
     * to the constructor
     * @param NULL $structure
     * @param string $basenode
     * @return mixed
     */
    public function toXml($data = null, $structure = null, $baseNode = 'xml')
    {
        // If no data passed, use the stored data
        if ($data === null && func_num_args() === 0) {
            $data = $this->data;
        }

        // Create the root XML element if none provided
        if ($structure === null) {
            $structure = simplexml_load_string(
                "<?xml version='1.0' encoding='utf-8'?><{$baseNode} />"
            );
        }

        // Ensure data is an array or object
        if (!is_array($data) && !is_object($data)) {
            $data = (array) $data;
        }

        foreach ($data as $key => $value) {
            // Convert booleans to 0/1
            if (is_bool($value)) {
                $value = (int) $value;
            }

            // Avoid numeric keys in XML
            if (is_numeric($key)) {
                $key = (singular($baseNode) != $baseNode) ? singular($baseNode) : 'item';
            }

            // Remove invalid XML characters from key
            $key = preg_replace('/[^a-z_\-0-9]/i', '', $key);

            // Handle attributes
            if ($key === '_attributes' && (is_array($value) || is_object($value))) {
                $attributes = is_object($value) ? get_object_vars($value) : $value;
                foreach ($attributes as $attrName => $attrValue) {
                    $structure->addAttribute($attrName, $attrValue);
                }
            }
            // Nested array/object: recursive call
            elseif (is_array($value) || is_object($value)) {
                $node = $structure->addChild($key);
                $this->toXml($value, $node, $key);
            }
            // Scalar value: add as child node
            else {
                $value = htmlspecialchars(
                    html_entity_decode($value, ENT_QUOTES, 'UTF-8'),
                    ENT_QUOTES,
                    'UTF-8'
                );
                $structure->addChild($key, $value);
            }
        }

        return $structure->asXML();
    }

    /**
     * Format data as HTML
     *
     * @param mixed|NULL $data Optional data to pass, so as to override the data passed
     * to the constructor
     * @return mixed
     */
    public function toHtml($data = null)
    {
        // If no data passed, use the stored data
        if ($data === null && func_num_args() === 0) {
            $data = $this->data;
        }

        // Ensure array format
        if (!is_array($data)) {
            $data = (array) $data;
        }

        // Determine if it's multi-dimensional
        if (isset($data[0]) && count($data) !== count($data, COUNT_RECURSIVE)) {
            // Multi-dimensional array
            $headings = array_keys($data[0]);
        } else {
            // Single row array
            $headings = array_keys($data);
            $data = [$data];
        }

        // Start HTML table
        $html = '<table border="1" cellpadding="4" cellspacing="0">' . PHP_EOL;

        // Table headings
        $html .= '<thead><tr>';
        foreach ($headings as $heading) {
            $html .= '<th>' . htmlspecialchars((string)$heading) . '</th>';
        }
        $html .= '</tr></thead>' . PHP_EOL;

        // Table rows
        $html .= '<tbody>';
        foreach ($data as $row) {
            $row = @array_map('strval', $row); // suppress array-to-string notice
            $html .= '<tr>';
            foreach ($row as $cell) {
                $html .= '<td>' . htmlspecialchars((string)$cell) . '</td>';
            }
            $html .= '</tr>' . PHP_EOL;
        }
        $html .= '</tbody>' . PHP_EOL;

        $html .= '</table>' . PHP_EOL;

        return $html;
    }
    /**
     * @link http://www.metashock.de/2014/02/create-csv-file-in-memory-php/
     * @param mixed|NULL $data Optional data to pass, so as to override the data passed
     * to the constructor
     * @param string $delimiter The optional delimiter parameter sets the field
     * delimiter (one character only). NULL will use the default value (,)
     * @param string $enclosure The optional enclosure parameter sets the field
     * enclosure (one character only). NULL will use the default value (")
     * @return string A csv string
     */
    public function toCsv($data = null, $delimiter = ',', $enclosure = '"')
    {
        // Open memory handle (1 MB limit)
        $handle = fopen('php://temp/maxmemory:1048576', 'w');
        if ($handle === false) {
            return null;
        }

        // Use stored data if none provided
        if ($data === null && func_num_args() === 0) {
            $data = $this->data;
        }

        // Default delimiter and enclosure
        if ($delimiter === null) {
            $delimiter = ',';
        }
        if ($enclosure === null) {
            $enclosure = '"';
        }

        // Ensure array format
        if (!is_array($data)) {
            $data = (array) $data;
        }

        // Detect multi-dimensional arrays for headings
        if (isset($data[0]) && count($data) !== count($data, COUNT_RECURSIVE)) {
            $headings = array_keys($data[0]);
        } else {
            $headings = array_keys($data);
            $data = [$data];
        }

        // Add CSV header row
        fputcsv($handle, $headings, $delimiter, $enclosure);

        foreach ($data as $record) {
            if (!is_array($record)) {
                break; // fputcsv needs an array
            }

            // Suppress array-to-string notices
            $record = @array_map('strval', $record);

            fputcsv($handle, $record, $delimiter, $enclosure);
        }

        // Reset pointer and fetch contents
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        // Convert to UTF-16LE for Excel compatibility
        return mb_convert_encoding($csv, 'UTF-16LE', 'UTF-8');
    }    

    /**
     * Encode data as json
     *
     * @param mixed|NULL $data Optional data to pass, so as to override the data passed
     * to the constructor
     * @return string Json representation of a value
     */
    public function toJson($data = null)
    {
        // If no data passed, use stored data
        if ($data === null && func_num_args() === 0) {
            $data = $this->data;
        }

        // Get the "callback" GET parameter
        $callback = service('request')->getGet('callback');

        if (empty($callback)) {
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }

        // Only allow valid JavaScript function names for JSONP
        if (preg_match('/^[a-z_\$][a-z0-9\$_]*(\.[a-z_\$][a-z0-9\$_]*)*$/i', $callback)) {
            return $callback . '(' . json_encode($data, JSON_UNESCAPED_UNICODE) . ');';
        }

        // Invalid JSONP callback — add warning
        $data['warning'] = 'INVALID JSONP CALLBACK: ' . $callback;
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Encode data as a serialized array
     *
     * @param mixed|NULL $data Optional data to pass, so as to override the data passed
     * to the constructor
     * @return string Serialized data
     */
    public function toSerialized($data = null)
    {
        // Use stored data if none provided
        if ($data === null && func_num_args() === 0) {
            $data = $this->data;
        }

        return serialize($data);
    }

    /**
     * Format data using a PHP structure
     *
     * @param mixed|NULL $data Optional data to pass, so as to override the data passed
     * to the constructor
     * @return mixed String representation of a variable
     */
    public function toPhp($data = null)
    {
        // Use stored data if none provided
        if ($data === null && func_num_args() === 0) {
            $data = $this->data;
        }

        return var_export($data, true);
    }

    // INTERNAL FUNCTIONS

    /**
     * @param string $data XML string
     * @return array XML element object; otherwise, empty array
     */
    protected function _fromXml($data)
    {
        return $data
            ? (array) simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA)
            : [];
    }   

    /**
     * @param string $data CSV string
     * @param string $delimiter The optional delimiter parameter sets the field
     * delimiter (one character only). NULL will use the default value (,)
     * @param string $enclosure The optional enclosure parameter sets the field
     * enclosure (one character only). NULL will use the default value (")
     * @return array A multi-dimensional array with the outer array being the number of rows
     * and the inner arrays the individual fields
     */
    protected function _fromCsv($data, $delimiter = ',', $enclosure = '"')
    {
        if ($delimiter === null) {
            $delimiter = ',';
        }

        if ($enclosure === null) {
            $enclosure = '"';
        }

        return str_getcsv($data, $delimiter, $enclosure);
    }

    /**
     * @param string $data Encoded json string
     * @return mixed Decoded json string with leading and trailing whitespace removed
     */
    protected function _fromJson($data)
    {
        return json_decode(trim($data));
    }

    /**
     * @param string $data Data to unserialize
     * @return mixed Unserialized data
     */
    protected function _fromSerialize($data)
    {
        return unserialize(trim($data));
    }

    /**
     * @param string $data Data to trim leading and trailing whitespace
     * @return string Data with leading and trailing whitespace removed
     */
    protected function _fromPhp($data)
    {
        return trim($data);
    }
}
