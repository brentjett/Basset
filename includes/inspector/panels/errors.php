<div id="errors-panel" class="inspector-panel staged" data-panel-width="700">

    <div class="back-panel-button" data-pop-inspector-panel>Back</div>

    <div class="inspector-section">
        <div class="section-title"><span class="dashicons dashicons-welcome-comments"></span> Errors</div>
        <div class="section-content padless">
            <? if ($errors = $basset->errors) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Message</th>
                        <th>File</th>
                        <th>Line</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach($errors as $error) { ?>
                    <tr>
                        <td><?php print $error['icon']?></td>
                        <td><?php print $error['message'] ?></td>
                        <td><?php print $error['file'] ?></td>
                        <td><?php print $error['line_number'] ?></td>
                    </tr>
                    <? } ?>
                </tbody>
            </table>
            <? } else { ?>
            No Errors Found
            <? } ?>
        </div>
    </div>
</div>
