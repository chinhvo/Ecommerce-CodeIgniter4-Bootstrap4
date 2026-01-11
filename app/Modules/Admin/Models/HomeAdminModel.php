<?php
namespace App\Modules\Admin\Models;
use CodeIgniter\Model;

class HomeAdminModel extends Model
{

    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['username', 'password', 'last_login'];

    public function loginCheck(array $values): ?array
    {
        $user = $this->where([
                'username' => $values['username'],
                'password' => md5($values['password'])
            ])
            ->first();

        if ($user) {
            $this->update($user['id'], ['last_login' => time()]);
        }

        return $user;
    }

    public function countLowQuantityProducts(): int
    {
        return $this->db->table('products')
            ->where('quantity <=', 5)
            ->countAllResults();
    }

    public function lastSubscribedEmailsCount(): int
    {
        $yesterday = strtotime('-1 day');
        return $this->db->table('subscribed')
            ->where('time >', $yesterday)
            ->countAllResults();
    }

    public function getMostSoldProducts(int $limit = 10): array
    {
        return $this->db->table('products')
            ->select('url, procurement')
            ->where('procurement >', 0)
            ->orderBy('procurement', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    public function getReferralOrders(): array
    {
        return $this->db->table('orders')
            ->select('COUNT(id) AS num, clean_referrer AS referrer')
            ->groupBy('clean_referrer')
            ->get()
            ->getResultArray() ?? [];
    }

    public function getOrdersByPaymentType(int $limit = 10): array
    {
        return $this->db->table('orders')
            ->select('COUNT(id) AS num, payment_type')
            ->groupBy('payment_type')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    public function getOrdersByMonth(): array
    {
        $result = $this->db->table('orders')
            ->select("YEAR(FROM_UNIXTIME(date)) AS year, MONTH(FROM_UNIXTIME(date)) AS month, COUNT(id) AS num", false)
            ->groupBy("YEAR(FROM_UNIXTIME(date)), MONTH(FROM_UNIXTIME(date))")
            ->get()
            ->getResultArray();

        $orders = [];
        $years = [];

        foreach ($result as $res) {
            if (!isset($orders[$res['year']])) {
                for ($i = 1; $i <= 12; $i++) {
                    $orders[$res['year']][$i] = 0;
                }
            }
            $years[] = $res['year'];
            $orders[$res['year']][$res['month']] = $res['num'];
        }

        return [
            'years'  => array_unique($years),
            'orders' => $orders
        ];
    }

    /*
     * Some statistics methods for home page of
     * administration
     * END
     */

    public function setValueStore(string $key, string $value): void
    {
        $builder = $this->db->table('value_store');

        $exists = $builder->where('thekey', $key)
                        ->countAllResults();

        if ($exists > 0) {
            if (! $builder->where('thekey', $key)->update(['value' => $value])) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        } else {
            if (! $builder->insert(['thekey' => $key, 'value' => $value])) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

    public function changePass(string $new_pass, string $username): bool
    {
        return $this->db->table('users')
            ->where('username', $username)
            ->update(['password' => md5($new_pass)]);
    }

    public function getValueStore(string $key): ?string
    {
        $value = $this->db->table('value_store')
            ->select('value')
            ->where('thekey', $key)
            ->get()
            ->getRowArray();

        return $value['value'] ?? null;
    }

    public function newOrdersCheck(): int
    {
        $row = $this->db->table('orders')
            ->selectCount('id', 'num')
            ->where('viewed', 0)
            ->get()
            ->getRowArray();

        return (int) ($row['num'] ?? 0);
    }

    public function setCookieLaw(array $post): void
    {
        $builder = $this->db->table('cookie_law');
        $query = $builder->select('id')->get();
        $row   = $query->getRowArray();
        $updateId = $row['id'] ?? false;

        $this->db->transBegin();

        if ($updateId === false) {
            // Insert into cookie_law
            $builder->insert([
                'link'       => $post['link'],
                'theme'      => $post['theme'],
                'visibility' => $post['visibility']
            ]);
            $forId = $this->db->insertID();

            // Insert translations
            foreach ($post['translations'] as $i => $translate) {
                $this->db->table('cookie_law_translations')->insert([
                    'message'     => htmlspecialchars($post['message'][$i]),
                    'button_text' => htmlspecialchars($post['button_text'][$i]),
                    'learn_more'  => htmlspecialchars($post['learn_more'][$i]),
                    'abbr'        => $translate,
                    'for_id'      => $forId
                ]);
            }
        } else {
            // Update cookie_law
            $builder->where('id', $updateId)->update([
                'link'       => $post['link'],
                'theme'      => $post['theme'],
                'visibility' => $post['visibility']
            ]);

            // Update translations
            foreach ($post['translations'] as $i => $translate) {
                $this->db->table('cookie_law_translations')
                    ->where('for_id', $updateId)
                    ->where('abbr', $translate)
                    ->update([
                        'message'     => htmlspecialchars($post['message'][$i]),
                        'button_text' => htmlspecialchars($post['button_text'][$i]),
                        'learn_more'  => htmlspecialchars($post['learn_more'][$i])
                    ]);
            }
        }

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            show_error(lang('database_error'));
        } else {
            $this->db->transCommit();
        }
    }

    public function getCookieLaw(): array
    {
        $result = [
            'cookieInfo'     => null,
            'cookieTranslate'=> null
        ];

        $cookieInfo = $this->db->table('cookie_law')->get()->getRowArray();

        if ($cookieInfo) {
            $result['cookieInfo'] = $cookieInfo;

            $translations = $this->db->table('cookie_law_translations')->get()->getResultArray();

            foreach ($translations as $trans) {
                $result['cookieTranslate'][$trans['abbr']] = [
                    'message'     => $trans['message'],
                    'button_text' => $trans['button_text'],
                    'learn_more'  => $trans['learn_more']
                ];
            }
        }

        return $result;
    }

}
