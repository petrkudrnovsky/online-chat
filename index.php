<?php
        function nactiTridu($trida) {
            require("tridy/$trida.php");
        }
        spl_autoload_register("nactiTridu");
        
        $chat_db = Databaze::pripoj("localhost", "root", "", "online_chat_db");
        
?>

<!DOCTYPE html>
<html lang="cs-cz">
    <head>
        <meta charset="UTF-8">
        <title>Online chat</title>
        <link href="styles.scss" rel="stylesheet">
    </head>
    <body>
        
        <div class="header">
            <h2>Petrovo diskuzní fórum</h2>
        </div>
       
        <form method="post">
            Přezdívka:<br>
            <input type="text" name="nickname"><br>
            Zpráva:<br>
            <textarea name="message" rows="6" cols="50"></textarea><br>
            <input type="submit" value="Odeslat" class="btn">
        </form>
        
        <?php
        
        if($_POST) {
            $message = htmlspecialchars($_POST["message"]);
            $nickname = htmlspecialchars($_POST["nickname"]);
            ChatHandler::saveUser($nickname, $message);
        };
        
        $uzivatele = ChatHandler::vypis();
        
        echo("<table>");
        foreach($uzivatele as $uzivatel) {
            echo("<tr>");
            echo("<td rowspan='3'><img src='obr/user_icon.png' alt='' width='100px'></td>");
            echo("<td>uživatel: <strong>$uzivatel[1]</strong></td></tr>");
            echo("<tr><td>zpráva: $uzivatel[2]</td></tr>");
            echo("<tr><td class='time'>" . date("d/m/Y H:i:s", $uzivatel[3]) . "</td></tr>");
            echo("<tr><td height='30px'></td></tr>");
        }
        echo("</table>");
        
        
        ?>
        <p class="konec">Zde forum končí - načítá se pouze posledních 10 příspěvků</p>
        <hr>
        <footer>
            <p>Vytvořil <strong>Petr Kudrnovský</strong>, Online Discussion Forum 0.2.1 2020 &copy; All right reserved</p>
        </footer>
    </body>
</html>
