<?php
/**
 *  verifica se chave existe num array
 */
function chk_array($array, $key)
{
    if (isset($array[$key]) and !empty($array[$key]))
    {
        return $array[$key];
    }
    return null;
}

/**
 *	retorna true se o valor de $value é igual a um dos elementos de $array
 */
function value_exists($value, $array)
{
	if (is_array($value) or !$array)
	{
		return false;
	}

	$array = explode(',', $array);
	$array = array_map('trim', $array);

	foreach ($array as $key => $value2)
	{	
		if ($value == $value2)
		{
			return true;
		}
	}
	return false;
}


/**
 *	Gera QR Codes de acordo com os dados passados
 *
 *	url -> url do servidor
 *	dados -> dados em array que irao entrar no QR Code
 */
function getQR($url, $dados)
{
	if (!$url or !$dados)
		return false;

	$qr = "d=http://{$url}?dados={$dados}&t=P&s=5e=H";
	return $qr;
}

/*
 *	converte datas
 */
function convertData($data)
{
	$data = explode("-", $data);

	$data = array_reverse($data);
	
	foreach ($data as $key => $value)
		$data[$key] = "<u>" . $value . "</u>";

	$data = implode(" / ", $data);

	return $data;
}

/**
 * Função que decodifica todos os elementos(do tipo string) de um array utf8.
 */
function all_decode(array $array)
{
	foreach ($array as $key => $value)
	{
		if (is_string($value))
		{
			$array[$key] = utf8_decode($value);
		}
	}
	return $array;
}

function all_encode(array $array)
{
	foreach ($array as $key => $value)
	{
		if (is_string($value))
		{
			$array[$key] = utf8_encode($value);
		}
	}
	return $array;
}

/**
 * Função que checa os indices de um array.
 * O array deve possuir TODOS e APENAS os índices indicados em $params
 * $params deve ser uma string que separa cada índice por vírgula.
 */
function check_keys(array $array, string $params)
{
	$params = explode(',', $params);
	$params = array_map('trim', $params);

	foreach ($array as $key => $value)
	{
		foreach ($params as $key2 => $value2)
		{
			if ($value2 == $key)
			{
				unset($array[$key]);
				break;
			}
		}
	}

	return !$array;
}


/**
 * Seta as avaliacoes de emprestimos pra mostrar la
 */
function turn($val)
{
	$turned = null;
	for ($i=1; $i < 6; $i++)
	{
		$val--;
		$turned[$i] = ($val < 0) ? "off" : "on";

		if (is_null($val))
			$turned[$i] = "null";
	}
	return $turned;
}

/**
 * Função para selecionar campo select se ja possuir valor
 */
function select($target, $value)
{
	echo ($target == $value) ? "selected" : "";
}

/**
 * Gera string aleatoria
 */
function randString(int $len)
{
	$base = "abcdefghijklmnopqrstuvwxysABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890.";

	$return = "";

	for ($i=0; $i < $len; $i++) { 
		$return .= $base[rand(0, strlen($base) - 1)];
	}
	
	return $return;
}
