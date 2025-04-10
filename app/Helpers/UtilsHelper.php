<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

function  obtenerPartidas($det_partidas, $ord_pag)
{
  $partidas = array_filter($det_partidas, function ($partida) use ($ord_pag) {
    return $partida['ord_pag'] == $ord_pag;
  });

  $partidas_formateadas = array_map(function ($partida) {
    return $partida['cod_cta'] . ': ' . number_format($partida['mto_tra'], 2, ',', '.') . ' Bs';
  }, $partidas);
  return implode("\n", $partidas_formateadas);
}

function  obtenerCtrCosto($det_partidas, $ord_pag)
{
  $partidas = array_filter($det_partidas, function ($partida) use ($ord_pag) {
    return $partida['ord_pag'] == $ord_pag;
  });

  $partidas_formateadas = array_map(function ($partida) {
    return $partida['ctr_costo'];
  }, $partidas);
  return implode("\n", $partidas_formateadas);
}

function obtenerCuentasContables($det_cuentas, $ord_pag)
{
  $ord_pag = (int) $ord_pag;

  $cuentas = array_filter($det_cuentas, function ($cuenta) use ($ord_pag) {
    return (int) $cuenta['ord_pag'] === $ord_pag;
  });

  $cuentas_formateadas = array_map(function ($cuenta) {
    return $cuenta['cta_con'] . ': ' . number_format($cuenta['monto'], 2, ',', '.') . ' Bs';
  }, $cuentas);

  return implode("\n", $cuentas_formateadas);
}

function parse_fecha($fecha)
{
  return Carbon::parse($fecha)->format('d/m/Y');
}

function formatNumber($num, $dec, $sepmiles, $puntodecimal, $neg)
{
  $sepmiles = ($puntodecimal == '.') ? "," : ".";
  $f = number_format($num, $dec, $sepmiles, $puntodecimal);
  if (strstr($f, "-") && $neg == "(") {
    $f = str_replace("-", "(", $f);
    $f .= ")";
  }
  return $f;
}

function formatDate($fecha, $dateformat)
{
  $val = "";
  switch ($dateformat) {
    case "DMY":
      $val = date("d/m/Y", $fecha);
      break;
    case "YMD":
      $val = date("Y/m/d", $fecha);
      break;
    case "MDY":
      $val = date("m/d/Y", $fecha);
      break;
  }
  return $val;
}

function formatMes($mes)
{
  return sprintf('%02d', $mes);
}

function FormatFechaAMD($fecha, $separador = '-')
{
  if (!empty($fecha)) {
    $sep = "[\/\-\.]";
    $fecha = explode(" ", $fecha);
    $fecha = $fecha[0];
    preg_match("/([0-9]{1,2})$sep([0-9]{1,2})$sep([0-9]{2,4})/", $fecha, $mfecha);
    $lfecha = $mfecha[3] . $separador . $mfecha[2] . $separador . $mfecha[1];
    return $lfecha;
  }
}

function cambiarFormatoFecha($fecha)
{
  list($anio, $mes, $dia) = explode("-", $fecha);
  return $dia . "/" . $mes . "/" . $anio;
}

function unidad($numuero)
{
  $numu = "";
  $numuero = trim($numuero);
  switch ($numuero) {
    case 9:
      $numu = "NUEVE";
      break;
    case 8:
      $numu = "OCHO";
      break;
    case 7:
      $numu = "SIETE";
      break;
    case 6:
      $numu = "SEIS";
      break;
    case 5:
      $numu = "CINCO";
      break;
    case 4:
      $numu = "CUATRO";
      break;
    case 3:
      $numu = "TRES";
      break;
    case 2:
      $numu = "DOS";
      break;
    case 1:
      $numu = "UNO";
      break;
  }
  return $numu;
}


function decena($numdero)
{
  $numd = "";
  if ($numdero >= 90 && $numdero <= 99) {
    $numd = "NOVENTA ";
    if ($numdero == 91)
      $numd = $numd . "Y UN";
    if ($numdero > 91) $numd = $numd . "Y " . (unidad($numdero - 90));
  } elseif ($numdero >= 80 && $numdero <= 89) {
    $numd = "OCHENTA ";
    if ($numdero == 81)
      $numd = $numd . "Y UN";
    if ($numdero > 81) $numd = $numd . "Y " . (unidad($numdero - 80));
  } elseif ($numdero >= 70 && $numdero <= 79) {
    $numd = "SETENTA ";
    if ($numdero == 71)
      $numd = $numd . "Y UN";
    if ($numdero > 71) $numd = $numd . "Y " . (unidad($numdero - 70));
  } elseif ($numdero >= 60 && $numdero <= 69) {
    $numd = "SESENTA ";
    if ($numdero == 61)
      $numd = $numd . "Y UN";
    if ($numdero > 61) $numd = $numd . "Y " . (unidad($numdero - 60));
  } elseif ($numdero >= 50 && $numdero <= 59) {
    $numd = "CINCUENTA ";
    if ($numdero == 51)
      $numd = $numd . "Y UN";
    if ($numdero > 51) $numd = $numd . "Y " . (unidad($numdero - 50));
  } elseif ($numdero >= 40 && $numdero <= 49) {
    $numd = "CUARENTA ";
    if ($numdero == 41)
      $numd = $numd . "Y UN";
    if ($numdero > 41) $numd = $numd . "Y " . (unidad($numdero - 40));
  } elseif ($numdero >= 30 && $numdero <= 39) {
    $numd = "TREINTA ";
    if ($numdero == 31)
      $numd = $numd . "Y UN";
    if ($numdero > 31) $numd = $numd . "Y " . (unidad($numdero - 30));
  } elseif ($numdero >= 20 && $numdero <= 29) {
    if ($numdero == 20)
      $numd = "VEINTE ";
    else
      $numd = "VEINTI ";
    if ($numdero == 21)
      $numd = $numd . "UN";
    if ($numdero > 21) $numd = $numd . " " . (unidad($numdero - 20));
  } elseif ($numdero >= 10 && $numdero <= 19) {
    $valor = substr($numdero, 0, 2);
    if ($valor == '10') {
      $numd = "DIEZ ";
    } // break;
    elseif ($valor == '11') {
      $numd = "ONCE ";
    } // break;
    elseif ($valor == '12') {
      $numd = "DOCE ";
    } // break;
    elseif ($valor == '13') {
      $numd = "TRECE ";
    } // break;
    elseif ($valor == '14') {
      $numd = "CATORCE ";
    } // break;
    elseif ($valor == '15') {
      $numd = "QUINCE ";
    } // break;
    elseif ($valor == '16') {
      $numd = "DIECISEIS ";
    } // break;
    elseif ($valor == '17') {
      $numd = "DIECISIETE ";
    } // break;
    elseif ($valor == '18') {
      $numd = "DIECIOCHO ";
    } // break;
    elseif ($valor == '19') {
      $numd = "DIECINUEVE ";
    }
  } else {
    $numd = unidad($numdero);
  }
  return $numd;
}


function centena($numc)
{
  $numce = ""; // Valor a devolver
  if ($numc >= 100) {
    if ($numc >= 900 && $numc <= 999) {
      $numce = "NOVECIENTOS ";
      if ($numc > 900) $numce = $numce . (decena($numc - 900));
    } elseif ($numc >= 800 && $numc <= 899) {
      $numce = "OCHOCIENTOS ";
      if ($numc > 800) $numce = $numce . (decena($numc - 800));
    } elseif ($numc >= 700 && $numc <= 799) {
      $numce = "SETECIENTOS ";
      if ($numc > 700) $numce = $numce . (decena($numc - 700));
    } elseif ($numc >= 600 && $numc <= 699) {
      $numce = "SEISCIENTOS ";
      if ($numc > 600) $numce = $numce . (decena($numc - 600));
    } elseif ($numc >= 500 && $numc <= 599) {
      $numce = "QUINIENTOS ";
      if ($numc > 500) $numce = $numce . (decena($numc - 500));
    } elseif ($numc >= 400 && $numc <= 499) {
      $numce = "CUATROCIENTOS ";
      if ($numc > 400) $numce = $numce . (decena($numc - 400));
    } elseif ($numc >= 300 && $numc <= 399) {
      $numce = "TRESCIENTOS ";
      if ($numc > 300) $numce = $numce . (decena($numc - 300));
    } elseif ($numc >= 200 && $numc <= 299) {
      $numce = "DOSCIENTOS ";
      if ($numc > 200) $numce = $numce . (decena($numc - 200));
    } elseif ($numc >= 100 && $numc <= 199) {
      if ($numc == 100)
        $numce = "CIEN ";
      else
        $numce = "CIENTO " . (decena($numc - 100));
    }
  } else {
    $numce = decena($numc);
  }
  return $numce;
}


function miles($nummero)
{
  $numm = ""; // valor a devolver
  if ($nummero >= 1000 && $nummero < 2000) {
    $numm = "MIL " . (centena($nummero % 1000));
  } elseif ($nummero >= 2000 && $nummero < 10000) {
    $numm = unidad(Floor($nummero / 1000)) . " MIL " . (centena($nummero % 1000));
  } elseif ($nummero < 1000) {
    $numm = centena($nummero);
  }
  return $numm;
}


function formatearValor($valor)
{
  $valor = (!empty($valor)) ? $valor : 0;
  $valor_formateado = str_replace(',', '.', str_replace('.', '', $valor));
  return floatval($valor_formateado);
}

function formatearNumero($numero)
{
  $numero = (!empty($numero)) ? $numero : 0;
  return number_format($numero, 2, ',', '.');
}
function decmiles($numdmero)
{
  $numde = ""; //Valor a Devolver
  if ($numdmero == 10000) {
    $numde = "DIEZ MIL";
  } elseif ($numdmero > 10000 && $numdmero < 20000) {
    $numde = decena(Floor($numdmero / 1000)) . "MIL " . (centena($numdmero % 1000));
  } elseif ($numdmero >= 20000 && $numdmero < 100000) {
    $numde = decena(Floor($numdmero / 1000));
    if (substr($numde, strlen($numde) - 3, 3) == "UNO") {
      $numde = substr($numde, 0, strlen($numde) - 3) . " UN MIL " . (miles($numdmero % 1000));
    } else {
      $numde = decena(Floor($numdmero / 1000)) . " MIL " . (miles($numdmero % 1000));
    }
  } elseif ($numdmero < 10000) {
    $numde = miles($numdmero);
  }
  return $numde;
}


function cienmiles($numcmero)
{
  $num_letracm = "";
  if ($numcmero == 100000) {
    $num_letracm = "CIEN MIL";
  } elseif ($numcmero >= 100000 && $numcmero < 1000000) {
    $num_letracm = centena(Floor($numcmero / 1000));
    if (substr($num_letracm, strlen($num_letracm) - 3, 3) == "UNO") {
      $num_letracm = substr($num_letracm, 0, strlen($num_letracm) - 3) . " UN MIL " . (centena($numcmero % 1000));
    } else {
      $num_letracm = centena(Floor($numcmero / 1000)) . " MIL " . (centena($numcmero % 1000));
    }
  } elseif ($numcmero < 100000) {
    $num_letracm = decmiles($numcmero);
  }
  return $num_letracm;
}
function cambiarFormatoNumero($cantidad)
{
  $cant = $cantidad;
  setType($cant, "string");
  if (((strlen(strchr($cant, '.'))) == 0)) {
    $cadena = $cant . ".00 ";
  } else {
    if ((strpos($cant, ".") + 2) == (strlen($cant))) {
      $cadena = $cant . "0 ";
    } else {
      $cadena = $cant . " ";
    }
  }

  return $cadena;
}
function formatDDMMYYYY($fecha)
{
  $fechaCarbon = Carbon::parse($fecha);
  return  $fechaCarbon->format('d-m-Y');
}

function formatoDDMMYYYY($fecha)
{
  $fechaCarbon = Carbon::parse($fecha);
  return  $fechaCarbon->format('d/m/Y');
}

function formatYYYYMMDD($fecha)
{
  $fechaCarbon = Carbon::parse($fecha);
  return  $fechaCarbon->format('Y-m-d');
}
function millon($nummiero)
{
  $num_letramm = ""; //Valor a Devolver
  if ($nummiero >= 1000000 && $nummiero < 2000000) {
    $num_letramm = "UN MILLON " . (cienmiles($nummiero % 1000000));
  } elseif ($nummiero >= 2000000 && $nummiero < 10000000) {
    $num_letramm = unidad(Floor($nummiero / 1000000)) . " MILLONES " . (cienmiles($nummiero % 1000000));
  } elseif ($nummiero < 1000000) {
    $num_letramm = cienmiles($nummiero);
  }
  return $num_letramm;
}


function decmillon($numerodm)
{
  $num_letradmm = ""; // Valor a devolver
  if ($numerodm == 10000000) {
    $num_letradmm = "DIEZ MILLONES";
  } elseif ($numerodm > 10000000 && $numerodm < 20000000) {
    $num_letradmm = decena(Floor($numerodm / 1000000)) . "MILLONES " . (cienmiles($numerodm % 1000000));
  } elseif ($numerodm >= 20000000 && $numerodm < 100000000) {
    $num_letradmm = decena(Floor($numerodm / 1000000)) . " MILLONES " . (millon($numerodm % 1000000));
  } elseif ($numerodm < 10000000) {
    $num_letradmm = millon($numerodm);
  }
  return $num_letradmm;
}

function cienmillon($numcmeros)
{
  $num_letracms = ""; // Valor a devolver
  if ($numcmeros == 100000000) {
    $num_letracms = "CIEN MILLONES";
  } elseif ($numcmeros >= 100000000 && $numcmeros < 1000000000) {
    $num_letracms = centena(Floor($numcmeros / 1000000));
    if (substr($num_letracms, strlen($num_letracms) - 3, 3) == "UNO") {
      $num_letracms = substr($num_letracms, 0, strlen($num_letracms) - 3) . "* UN MILLONES " . (millon($numcmeros % 1000000));
    } else {
      $num_letracms = centena(Floor($numcmeros / 1000000)) . " MILLONES " . (millon($numcmeros % 1000000));
    }
  } elseif ($numcmeros < 100000000) {
    $num_letracms = decmillon($numcmeros);
  }
  return $num_letracms;
}

function milmillon($nummierod)
{
  $num_letrammd = ""; // Valor a Devolver
  if ($nummierod >= 1000000000 && $nummierod < 2000000000) {
    $num_letrammd = "MIL " . (cienmillon($nummierod % 1000000000));
  } elseif ($nummierod >= 2000000000 && $nummierod < 10000000000) {
    $num_letrammd = unidad(Floor($nummierod / 1000000000)) . " MIL " . (cienmillon($nummierod % 1000000000));
  } elseif ($nummierod < 1000000000) {
    $num_letrammd = cienmillon($nummierod);
  }
  return $num_letrammd;
}


function convertirLetrasMonto($numero, $puntodecimal = '.', $conCentimos = true)
{
  $snumero = "" . $numero; // Convertir a String

  $partes = preg_split("/" . $puntodecimal . "/", $numero);

  /********************************/
  $tt = round($numero, 2);
  $numero = intval($tt);
  $dec = $tt - intval($tt);
  //Hay que redondear los decimales
  $decimales = round($dec * 100) / 100;
  $decimales2 = substr($decimales, strpos($decimales, '.') + 1, 2); //*(100);
  $decimales3 = substr($decimales, strpos($decimales, '.') + 1, 3); //*(100);
  if (!$conCentimos) {
    $val = milmillon($numero);
  } else {
    if (!$decimales) { // No requiere moneda
      $val = milmillon($numero) . " CON 00/100 CENTIMOS";
    } else { // requiere 00/100
      if (substr($decimales2, 0, 1) == "0") { // MENOR A DECENA
        $val = milmillon($numero) . " CON CERO " . unidad($decimales3) . " CENTIMOS";
      } else {
        $decimales = $decimales * 100;
        $val = milmillon($numero) . " CON " . decena($decimales) . " CENTIMOS";
      }
    }
  }
  return $val;
}

function formatear($valor, $n)
{
  $str = '';
  $n = $n - strlen($valor);
  for ($i = 0; $i < $n; $i++) {
    $str .= '0';
  }
  $str .= $valor;
  return $str;
}

function desarm_cod_com($cadena)
{
  $cad = array();
  $j = 0;
  for ($i = 0; $i <= strlen($cadena); $i++) {
    $cad2 = substr($cadena, $i, 2);
    if (substr($cad2, 0, 1) == '0') {
      $cad2 = substr($cadena, $i + 1, 1);
    }
    $cad[$j] = $cad2;
    $i = $i + 2;
    $j++;
  }

  return $cad;
}

function FechaSistema($ano_pro, $format = 'YmdHis')
{
  date_default_timezone_set("America/Caracas");
  $ano_actual = date('Y');

  if ($ano_pro != $ano_actual) {
    $fecha1 = "$ano_pro-12-31 20:00";
    $fecha = date($format, strtotime($fecha1));
  } else {
    $fecha = date($format);
  }
  return $fecha;
}

function getUbiProv($edo, $mun)
{
  $des = '';
  $result = DB::table('adm_ubigeograficas')
    ->select(DB::raw('UPPER(des_ubi) AS des_ubi'))
    ->where('cod_edo', $edo)
    ->where('cod_mun', $mun)
    ->get();

  if ($result->isNotEmpty()) {
    $des = $result->first()->des_ubi;
  }

  return $des;
}

function getMes($mes)
{
  $xmes = '';
  switch ($mes) {
    case 1:
      $xmes = "Enero";
      break;
    case 2:
      $xmes = "Febrero";
      break;
    case 3:
      $xmes = "Marzo";
      break;
    case 4:
      $xmes = "Abril";
      break;
    case 5:
      $xmes = "Mayo";
      break;
    case 6:
      $xmes = "Junio";
      break;
    case 7:
      $xmes = "Julio";
      break;
    case 8:
      $xmes = "Agosto";
      break;
    case 9:
      $xmes = "Septiembre";
      break;
    case 10:
      $xmes = "Octubre";
      break;
    case 11:
      $xmes = "Noviembre";
      break;
    case 12:
      $xmes = "Diciembre";
      break;
  }
  return $xmes;
}
function FechaExcel($date)
{
  if ($date == '') {
    return $date;
  } else {
    $fecha_tiempo = strtotime($date);
    // number of seconds in a day
    $seconds_in_a_day = 86400;
    // Unix timestamp to Excel date difference in seconds
    $ut_to_ed_diff = $seconds_in_a_day * 25569;
    $fecha_excel = ($fecha_tiempo + $ut_to_ed_diff) / $seconds_in_a_day;
    return $fecha_excel;
  }
}

function uCase($string)
{
  return ucwords(trim($string));
}

function armar_cod_com($tip_cod, $cod_pryacc, $cod_obj, $gerencia, $unidad, $cod_par, $cod_gen, $cod_esp, $cod_sub)
{
  $str = formatear($tip_cod, 2) . "." . formatear($cod_pryacc, 2) . "." . formatear($cod_obj, 2) . "." .
    formatear($gerencia, 2) . "." . formatear($unidad, 2) . "." . formatear($cod_par, 2) . "." .
    formatear($cod_gen, 2) . "." . formatear($cod_esp, 2) . "." . formatear($cod_sub, 2);
  return $str;
}


function getValfecha($fecha, $valor, $formato = 'YMD')
{
  $fecha = str_replace('-', '/', $fecha);
  $afecha = explode('/', $fecha);
  // valores de Indices para cada parte de fecha segun formato
  $dia = 0;
  $mes = 0;
  $ano = 0;
  switch ($formato) {
    case "DMY":
      $dia = 0;
      $mes = 1;
      $ano = 2;
      break;
    case "MDY":
      $dia = 1;
      $mes = 0;
      $ano = 2;
      break;
    case "YMD":
      $dia = 2;
      $mes = 1;
      $ano = 0;
      break;
  }
  $val = 0;
  switch ($valor) {
    case 'D':
      $val = $afecha[$dia];
      break;
    case 'M':
      $val = $afecha[$mes];
      break;
    default:
      $val = $afecha[$ano];
      break;
  }
  return $val;
}

function truncate($number) {
    $decimals = 2;
    $factor = pow(10, $decimals);
    return floor($number * $factor) / $factor;
}

function ultimoDiaMes($y, $m, $format = "d")
{
	$m = str_pad($m, 2, "0", STR_PAD_LEFT);
	$mkDate = strtotime("$y-$m-01");
	$month = date("Y-m-d", strtotime("+1 month", $mkDate));
	$mkDate = strtotime($month);
	$day= date($format, strtotime("-1 day", $mkDate));
	return $day;
}
function getip(): string
{
    if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) { // Soporte de Cloudflare
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } elseif (isset($_SERVER['DIRECCIÓN REMOTA']) === true) {
        $ip = $_SERVER['DIRECCIÓN REMOTA'];
        if (preg_match('/^(?:127|10)\.0\.0\.[12]?\d{1,2}$/', $ip)) {
            if (isset($_SERVER['HTTP_X_REAL_IP'])) {
                $ip = $_SERVER['HTTP_X_REAL_IP'];
            } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
    } else {
        $ip = '127.0.0.1';
    }
    if (in_array($ip, ['::1', '0.0.0.0', 'localhost'], true)) {
        $ip = '127.0.0.1';
    }
    $filter = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    if ($filter === false) {
        $ip = '127.0.0.1';
    }

    return $ip;
}
