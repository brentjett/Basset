<p>This is the default styling for this site. This is a static page to demostrate the appearance of various elements and components and how t use them.</p>

<section id="colors">
    <h2>Colors</h2>

    Assum typi non habent, claritatem insitam est usus. Suscipit lobortis nisl ut aliquip ex ea commodo consequat, duis autem vel eum iriure. Parum claram anteposuerit, litterarum formas humanitatis per seacula quarta decima et quinta. Esse molestie consequat, vel illum dolore eu feugiat? Nulla facilisi nam liber tempor cum soluta nobis eleifend option congue. Minim veniam quis nostrud exerci tation ullamcorper dolor in hendrerit in. Elit sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Et accumsan et iusto odio dignissim qui blandit.
    <?php
    $vars = array(
        'primary_color' => '',
        'primary_text_color' => '',
        'secondary_color' => '',
        'secondary_text_color' => '',
        'accent_color' => '',
        'accent_text_color' => ''
    );
    foreach($vars as $key => $val) {
        $vars[$key] = get_theme_mod($key, basset_get_default($key));
    }
    extract($vars);
    ?>
    <div style="text-align:center">
        <div class="color-sample" style="background-color:<?=$primary_color?>; color:<?=$primary_text_color?>">Primary Color</div>
        <div class="color-sample" style="background-color:<?=$secondary_color?>; color:<?=$secondary_text_color?>">Secondary Color</div>
        <div class="color-sample" style="background-color:<?=$accent_color?>; color:<?=$accent_text_color?>">Accent Color</div>
    </div>
</section>

<h1>Heading 1</h1>
<h2>Heading 2</h2>
<h3>Heading 3</h3>
<h4>Heading 4</h4>
<h5>Heading 5</h5>
<h6>Heading 6</h6>

[basset_cta]This is a call to action block [/basset_cta]
