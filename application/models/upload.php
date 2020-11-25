
<?php

class upload{

function upload_arquivos($arquivo){



	$formatos = array("png", "jpg", "pdf", "doc","txt");

//pega extensao do arquivo
$extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);



if ($extensao == "") {
	echo 'selecione algum arquivo';
} else {
	if (in_array($extensao, $formatos)) {



		//da um novo nome ao arquivo para nao haver sobreposição
		$pasta = "FILES/UPLOADS/";
		$temporario = $arquivo['tmp_name'];
		$novonome = uniqid() . ".$extensao";

		//finalmente faz o upload
		if (move_uploaded_file($temporario, $pasta . $novonome)) {
			$novonome= $novonome;
		} else {
			$novonome=null;
		}
	} else {

		echo "<script>alert('formato invalido!');history.back();</script>";
		exit;
	}
}


return $novonome;

}
}
