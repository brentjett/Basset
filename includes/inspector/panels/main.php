<?php
global $template, $basset;

$theme = wp_get_theme();
if ($parent = $theme->get('Template')) {
    $parent_theme = wp_get_theme($parent);
}

$path_dirs = explode('/', dirname($template));
$dirs_count = count($path_dirs);
$theme_name = $path_dirs[$dirs_count - 1]; // Get last folder of path

$template_name = basename($template);
?>
<div id="inspector_main_panel" class="inspector-panel active">

    <div class="inspector-section">
        <div class="section-title"><span class="dashicons dashicons-media-code"></span> Theme</div>
        <div class="section-content padless">
            <table>
                <tbody>
                    <tr>
                        <td>Active Theme</td>
                        <td><?=get_current_theme()?></td>
                    </tr>
                    <? if ($parent_theme) { ?>
                    <tr>
                        <td>Parent Theme</td>
                        <td><?=$parent_theme->get('Name')?></td>
                    </tr>
                    <? } ?>
                    <tr>
                        <td>Template</td>
                        <td><?php print $theme_name ?> > <?php print $template_name?></td>
                    </tr>
                </tbody>
            </table>
        </div><!-- .section-content -->
        <div class="section-footer"></div>
    </div>

    <div class="inspector-section">
        <div class="section-title"><span class="dashicons dashicons-welcome-comments"></span> Content</div>
        <div class="section-content padless">
            <ul>
                <li data-display-inspector-panel="nav-panel">Pages</li>
            </ul>
        </div>
    </div>

    <div class="inspector-section">
        <div class="section-title"><span class="dashicons dashicons-admin-tools"></span> Configuration <span class="actions">Edit</span></div>
        <div class="section-content">
            <?
            if ($basset->config_paths) {
                foreach($basset->config_paths as $path) {
                    ?><div><? print $path?></div><?
                }
            }
            ?>
        </div>
        <div class="section-footer"></div>
    </div>

    <? if ($errors = $basset->errors) { ?>
    <div class="inspector-section">
        <div class="section-title"><span class="dashicons dashicons-welcome-comments"></span> Errors <span class="actions" data-display-inspector-panel="errors-panel">Details</span></div>
        <div class="section-content padless">
            <table>
                <tbody>
                <? foreach($errors as $error) { ?>
                    <tr>
                        <td><?php print $error['icon']?></td>
                        <td><? print $error['message'] ?></td>
                    </tr>
                <? } ?>
            </tbody>
        </table>
        </div>
    </div>
    <? } ?>

    <div class="inspector-section">
        <div class="section-title"><span class="dashicons dashicons-welcome-comments"></span> Theme Support</div>
        <div class="section-content padless">
            <table>
                <tbody>
                    <tr>
                        <?php
                        current_theme_supports('title-tag') ? $checked = 'checked' : $checked = false;
                        ?>
                        <td>Title Tag</td>
                        <td><input type="checkbox" <?=$checked?>></td>
                    </tr>
                    <tr>
                        <?php
                        current_theme_supports('post-thumbnails') ? $checked = 'checked' : $checked = false;
                        ?>
                        <td>Featured Image</td>
                        <td><input type="checkbox" <?=$checked?>></td>
                    </tr>
                    <tr>
                        <?php
                        current_theme_supports('post-formats') ? $checked = 'checked' : $checked = false;
                        ?>
                        <td>Post Formats</td>
                        <td><input type="checkbox" <?=$checked?>></td>
                    </tr>
                    <tr>
                        <?php
                        current_theme_supports('menus') ? $checked = 'checked' : $checked = false;
                        ?>
                        <td>Nav Menus</td>
                        <td><input type="checkbox" <?=$checked?>></td>
                    </tr>
                    <tr>
                        <?php
                        current_theme_supports('widgets') ? $checked = 'checked' : $checked = false;
                        ?>
                        <td>Widgets</td>
                        <td><input type="checkbox" <?=$checked?>></td>
                    </tr>
                    <tr>
                        <?php
                        current_theme_supports('automatic-feed-links') ? $checked = 'checked' : $checked = false;
                        ?>
                        <td>Automatic Feed Links</td>
                        <td><input type="checkbox" <?=$checked?>></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <? /*
    <div class="inspector-section">
        <div class="section-title"><span class="dashicons dashicons-welcome-comments"></span> Stylesheets</div>
        <div class="section-content">
        <?php

        ?>
        </div>
    </div>
    */ ?>

</div><!-- /.inspector-panel -->
