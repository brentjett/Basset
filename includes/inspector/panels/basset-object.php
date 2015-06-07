<div id="basset-object-panel" class="inspector-panel staged" data-panel-width="700">

    <div class="back-panel-button" data-pop-inspector-panel>Back</div>

    <?php
    global $basset;
    $object = $basset;
    /*
    $object->is_enabled = true;
    $object->colors = array('red', 'blue', 'green');
    $object->title = "This is a title";
    $object->hours = array(
        'm-f' => '2:30 - 5:30',
        'sat' => '9am - 5pm',
        'sun' => '10am - 4pm'
    );
    */

    ?>
    <div class="inspector-section">
        <div class="section-title"><span class="dashicons dashicons-welcome-comments"></span> Basset Object</div>
        <div class="section-content padless">
            <? basset_print_property_list("basset_object_property_list", $object) ?>
        </div>
    </div>


</div>
