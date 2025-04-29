<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    echo "There was a problem with your submission, please try again.";
} else {
    header("Content-Type: application/json");
    $key= '#_MMxMCo9r-Z-1=';
    $who= $_POST['mpartyid'];
    if ($_POST['accesKey'] == $key){
        require('xlsxwriter.class.php');
        // $conn = new mysqli('localhost', 'root', 'Isma2003051003', 'movaparty');
        $conn = new mysqli('localhost', 'ideas_digitales', '^$76_,di%HFJ', 'id_wedding');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT mname, email, phone, adults, underages, adult_1, adult_2, adult_3, adult_4, adult_5, under_1, under_2, under_3, under_4, under_5, messages FROM quince WHERE party_id = '1'";
        $result = $conn->query($sql);
        $conn->close();
        $fname= 'Invitados_'. date('d-m-y_His').'.xlsx';
        $header = array(
            'Nombre'=> 'string',
            'Email'=> 'string',
            'Teléfono'=> 'integer',
            'Acompañantes adultos'=> 'integer',
            'Acompañantes menores edad'=> 'integer',
            'Invitado adulto 1'=> 'string',
            'Invitado adulto 2'=> 'string',
            'Invitado adulto 3'=> 'string',
            'Invitado adulto 4'=> 'string',
            'Invitado adulto 5'=> 'string',
            'Invitado menor edad 1'=> 'string',
            'Invitado menor edad 2'=> 'string',
            'Invitado menor edad 3'=> 'string',
            'Invitado menor edad 4'=> 'string',
            'Invitado menor edad 5'=> 'string',
            'Mensaje'=> 'string',
        );

        $hstyle= array('font-style'=>'bold', 'color'=>'#fff','fill'=>'#1b928a');
        $style = array('halign'=>'center');
        $widths = array(25,25,13,22,28,25,25,25,25,25,25,25,25,25,25,60);
        $col_options =array(
                'widths'=> $widths,
                $hstyle, $hstyle,$hstyle,$hstyle,$hstyle,$hstyle,$hstyle,$hstyle,$hstyle,$hstyle,$hstyle,$hstyle,$hstyle,$hstyle,$hstyle,$hstyle
        );
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $writer = new XLSXWriter();
        $writer->setAuthor('Mova Eventos');
        $writer->writeSheetHeader('Lista de Invitados', $header, $col_options);
        foreach($data as $row) {
            $writer->writeSheetRow('Lista de Invitados', $row, $style);
        }
        $writer->writeToFile($fname);
        $json = json_encode(
            array(
                'type'=>'success',
                'file'=> $fname
            )
        );
    } else {
        $json = json_encode(
            array(
                'type'=>'error'
            )
        );
    };
    echo $json;
};