<?php
$facebookFollowUrl = !empty($footerSocialFacebook)
    ? html_entity_decode((string) $footerSocialFacebook, ENT_QUOTES, 'UTF-8')
    : 'https://www.facebook.com/thegioixechaydien.com.vn';
$zaloFollowUrl = !empty($footerSocialZalo)
    ? html_entity_decode((string) $footerSocialZalo, ENT_QUOTES, 'UTF-8')
    : '';
?>

<div id="onesignal-slidedown-dialog" class="onesignal-slidedown-dialog" role="dialog" aria-live="polite" aria-label="Follow page prompt">
    <div id="normal-slidedown">
        <div class="slidedown-body d-flex align-items-center flex-wrap" id="slidedown-body">
            <div class="slidedown-body-icon mr-3">
                <img alt="notification icon" src="https://img.onesignal.com/t/fa0d60f0-7b2c-43b7-a20d-ccecb8922c0e.jpg" class="rounded">
            </div>
            <div class="slidedown-body-message flex-grow-1">
                Theo Dõi Để Nhận Thông Tin Mới Nhất Từ Thế Giới Xe Chạy Điện
            </div>
            <div id="onesignal-loading-container"></div>
        </div>
        <div class="slidedown-footer d-flex justify-content-end" id="slidedown-footer">
            <button type="button" class="btn btn-primary btn-sm slidedown-button mr-2" id="onesignal-slidedown-allow-button">THEO DÕI</button>
            <?php if (!empty($zaloFollowUrl)) { ?>
                <button type="button" class="btn btn-info btn-sm slidedown-button mr-2" id="onesignal-slidedown-zalo-button">ZALO</button>
            <?php } ?>
            <button type="button" class="btn btn-secondary btn-sm slidedown-button" id="onesignal-slidedown-cancel-button">CÁM ƠN</button>
        </div>
    </div>
</div>

<script>
    (function () {
        var storageKey = 'axc_follow_prompt_seen';
        var cookieKey = 'axc_follow_prompt_seen';
        var followFacebookUrl = <?= json_encode($facebookFollowUrl, JSON_UNESCAPED_SLASHES) ?>;
        var followZaloUrl = <?= json_encode($zaloFollowUrl, JSON_UNESCAPED_SLASHES) ?>;

        function getCookie(name) {
            var value = '; ' + document.cookie;
            var parts = value.split('; ' + name + '=');
            if (parts.length === 2) {
                return parts.pop().split(';').shift();
            }
            return null;
        }

        function setSeen() {
            try {
                window.localStorage.setItem(storageKey, '1');
            } catch (e) {
                // localStorage may be blocked, cookie fallback still works.
            }

            var maxAge = 60 * 60 * 24 * 365;
            document.cookie = cookieKey + '=1; path=/; max-age=' + maxAge;
        }

        function wasSeen() {
            try {
                if (window.localStorage.getItem(storageKey) === '1') {
                    return true;
                }
            } catch (e) {
                // Ignore and continue with cookie check.
            }
            return getCookie(cookieKey) === '1';
        }

        function closePrompt() {
            var prompt = document.getElementById('onesignal-slidedown-dialog');
            if (!prompt) {
                return;
            }
            prompt.style.display = 'none';
            document.body.style.paddingTop = '';
        }

        document.addEventListener('DOMContentLoaded', function () {
            var prompt = document.getElementById('onesignal-slidedown-dialog');
            var allowBtn = document.getElementById('onesignal-slidedown-allow-button');
            var zaloBtn = document.getElementById('onesignal-slidedown-zalo-button');
            var cancelBtn = document.getElementById('onesignal-slidedown-cancel-button');

            if (!prompt || !allowBtn || !cancelBtn) {
                return;
            }

            if (wasSeen()) {
                return;
            }

            prompt.style.display = 'block';
            document.body.style.paddingTop = prompt.offsetHeight + 'px';

            allowBtn.addEventListener('click', function () {
                setSeen();
                closePrompt();
                if (followFacebookUrl) {
                    window.location.href = followFacebookUrl;
                }
            });

            if (zaloBtn) {
                zaloBtn.addEventListener('click', function () {
                    setSeen();
                    closePrompt();
                    if (followZaloUrl) {
                        window.location.href = followZaloUrl;
                    }
                });
            }

            cancelBtn.addEventListener('click', function () {
                setSeen();
                closePrompt();
            });
        });
    })();
</script>