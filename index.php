<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Online chat</title>
    </head>
    <body>
        <h2>Petrovo diskuzní fórum</h2>
        <?php
        function nactiTridu($trida) {
            require("tridy/$trida.php");
        }
        spl_autoload_register("nactiTridu");
        
        $chat_db = Databaze::pripoj("localhost", "root", "", "online_chat_db");
        
        if($_POST) {
            $message = $_POST["message"];
            $nickname = $_POST["nickname"];
            ChatHandler::saveUser($nickname, $message);
        };
        
        $uzivatele = ChatHandler::vypis();
        
        echo("<table>");
        foreach($uzivatele as $uzivatel) {
            echo("<tr>");
            echo("<td rowspan='3'><img src='obr/user_icon.png' alt='' width='100px'></td>");
            echo("<td>uživatel: <strong>$uzivatel[1]</strong></td></tr>");
            echo("<tr><td>zpráva: $uzivatel[2]</td></tr>");
            echo("<tr><td>čas:" . date("d/m/Y h:i:s", $uzivatel[3]) . "</td></tr>");
            echo("<tr><td height='30px'></td></tr>");
        }
        echo("</table>");
        
        
        ?>
        <form method="post" style="border: 3px solid black; padding: 20px;">
            Přezdívka:<br>
            <input type="text" name="nickname"><br>
            Zpráva:<br>
            <textarea name="message"></textarea><br>
            <input type="submit" value="Odeslat">
        </form>
    </body>
</html>
