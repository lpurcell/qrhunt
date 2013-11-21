    <?php
    // Were there any variables set via PHP for use in the JavaScript?
    if (!empty($participants)) {
        echo "<script type='text/javascript'>\n";
        echo "var participants = " . json_encode($participants) . "\n";
        echo "var event = " . json_encode($event) . "\n";
        echo "</script>\n";
    }
    ?>
<script src="<?php echo base_url()?>assets/js/qrcode_SJIS.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/qrcode.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/generate.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/jspdf.js"></script>
<script src="<?php echo base_url()?>assets/js/jspdf.plugin.standard_fonts_metrics.js"></script>
<script src="<?php echo base_url()?>assets/js/jspdf.plugin.split_text_to_size.js"></script>
<script src="<?php echo base_url()?>assets/js/jspdf.plugin.from_html.js"></script>
<script src="<?php echo base_url()?>assets/js/jspdf.plugin.addimage.js"></script>
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

<h1>Your labels are being generated.</h1>

<p>Please be patient! This may take a few minutes. If you don't see your labels, your pop-up blocker may be blocking
them. Please allow pop-ups and try again.</p>

    <canvas id="myCanvas" width="200" height="100"></canvas>
    <br />

    <script type="text/javascript">
        generateForPDF(participants, event);
    </script>