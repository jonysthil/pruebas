<h2 align=center>
    <?php /* mod_rewrite Test Page *//* Copyright 2006 Webune.com */
    if ($_GET['link'] == 1) {
        echo '<span style="color:red">You are not using mod_rewrite - Try LINK2</span>';
    } elseif ($_GET['link'] == 2) {
        echo '<span style="color:green">Congratulations!! You are using Apache mod_rewrite</span>';
    } else {
        echo '<span style="color:blue">Linux Apache mod_rewrite Test</span>';
    } 
    ?>
</h2>
<hr>
<title>Test mod_rewrite in Apache Linux Server</title>
<p>
    <a href="rewrite.php?link=1" style="color:red"><strong>LINK 1</strong></a> = LINK 1 Does NOT use Mod Rewrite. LINK 1 uses standard URL: <u>rewrite.php?link=1</u>
</p>
<p>
    <a href="link2.html" style="color:green"><strong>LINK 2</strong></a> = LINK 2 - Yes, Uses Apache's Mod Rewrite using this URL:: <u>link2.html</u>
    <br>
    <br>
    <br>
    How this works: both links are for this same page, except they both are different. link one is without the mod_rewrite and link2 is using mod_rewrite. Link1 show the php file, with with mod_rewrite we are mascarading the php file into a html file. you can use whatever type of extension you want, you can change it to .htm or .shtml etc... all you have to do is to make sure you also chang it in the .htaccess file
</p>
<p>NOTE: when you click on LINK2, you should see a message that says: Congratulations!! You are using Apache mod_rewrite</p>
<p>500 ERROR: If you get a 500 Error, this means you made a typo or mistake creating the files OR you are not allowed to use .htaccess</p>
<p>404 ERROR: if you get a 404 error, then this means you do not have Mod_Rewrite on this server.</p>

