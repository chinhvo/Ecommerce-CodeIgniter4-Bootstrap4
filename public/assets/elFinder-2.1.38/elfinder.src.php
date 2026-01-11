<link rel="stylesheet" type="text/css" href="../js/jquery-ui.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/elfinder.min.css">
<link rel="stylesheet" type="text/css" href="css/theme.css">
<script src="js/elfinder.min.js"></script>
<script type="text/javascript" charset="utf-8">
    $().ready(function () {
        window.setTimeout(function () {
            const urlParmas = new URLSearchParams(window.location.search);
            const uid = urlParmas.get('uid');
            var langCode = window.location.search.replace(/^.*langCode=([a-z]{2}).*$/, "$1");
            var funcNum = window.location.search.replace(/^.*CKEditorFuncNum=(\d+).*$/, "$1");
            
            var elf = $('#elfinderExt').elfinder({
              url: '../elFinder-2.1.38/php/connector.minimal.php?uid='+uid,    
              lang : langCode, 
              getFileCallback : function(file, fm){
                  var fileUrl = file.url;
                  var imgFullPath = new URL(fm.convAbsUrl(fileUrl));
                  var relImgPath = imgFullPath.pathname;
                  window.opener.CKEDITOR.tools.callFunction(funcNum, relImgPath);
                  window.close();                
              }          
            }).elfinder('instance');
        }, 200);
    });
</script>

<h1><img src="../imgs/filemanager.png" class="header-img"> File Manager</h1>
<p>Here you can list all site files</p>
<hr>
<div class="alert alert-danger">Danger zone! Do not touch if you're not sure!</div>
<div id="elfinderExt"></div>