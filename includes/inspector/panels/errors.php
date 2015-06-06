<div id="errors-panel" class="inspector-panel staged" data-panel-width="700">

    <div class="back-panel-button" data-pop-inspector-panel>Back</div>

    <div class="inspector-section">
        <div class="section-title"><span class="dashicons dashicons-welcome-comments"></span> Errors</div>
        <div class="section-content padless">
            <? if ($errors = $basset->errors) { ?>
            <table>
                <tbody>
                    <? foreach($errors as $error) { ?>
                    <tr>
                        <td><? print $error['type'] ?></td>
                        <td><? print $error['message'] ?></td>
                        <td><? print $error['file'] ?></td>
                        <td><? print $error['line_number'] ?></td>
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
