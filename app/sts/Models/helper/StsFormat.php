<?php

namespace App\sts\Models\helper;

class StsFormat
{

    private $Dados;
    private $Formato;
    private $Resultado;

    //Remove acentos de strings.
    function removerAcentos($string = null)
    {
        $procurar = array("À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï", "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "ü", "Ý", "Þ", "ß", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ý", "ý", "þ", "ÿ", "R", "r", " ", "!", "@", "#", "$", "%", "&", "*", "(", ")", "_", "+", "=", "{", "[", "}", "]", "?", ";", ":", ".", ",", "'.\.'", ",", "'", "<", ">", "°", "º", "ª", '"', "/");
        $remover = array("A", "A", "A", "A", "A", "A", "A", "C", "C", "E", "E", "E", "I", "I", "I", "I", "D", "N", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "u", "Y", "B", "S", "a", "a", "a", "a", "a", "a", "a", "c", "e", "e", "e", "e", "i", "i", "i", "i", "o", "n", "o", "o", "o", "o", "o", "o", "u", "u", "u", "y", "y", "b", "y", "R", "r", " ", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        return str_replace($procurar, $remover, $string);
    }


    function gen_uuid()
    {
        $uuid = array(
            'time_low'  => 0,
            'time_mid'  => 0,
            'time_hi'  => 0,
            'clock_seq_hi' => 0,
            'clock_seq_low' => 0,
            'node'   => array()
        );

        $uuid['time_low'] = mt_rand(0, 0xffff) + (mt_rand(0, 0xffff) << 16);
        $uuid['time_mid'] = mt_rand(0, 0xffff);
        $uuid['time_hi'] = (4 << 12) | (mt_rand(0, 0x1000));
        $uuid['clock_seq_hi'] = (1 << 7) | (mt_rand(0, 128));
        $uuid['clock_seq_low'] = mt_rand(0, 255);

        for ($i = 0; $i < 6; $i++) {
            $uuid['node'][$i] = mt_rand(0, 255);
        }

        $uuid = sprintf(
            '%08x-%04x-%04x-%02x',
            $uuid['time_low'],
            $uuid['time_mid'],
            $uuid['time_hi'],
            $uuid['clock_seq_hi'],
            $uuid['clock_seq_low'],
            $uuid['node'][0],
            $uuid['node'][1],
            $uuid['node'][2],
            $uuid['node'][3],
            $uuid['node'][4],
            $uuid['node'][5]
        );

        return $uuid . date('HYmids');
    }


    function escapePassword($string = null)
    {
        $procurar = array("&", "<", ">", "'", '"');
        $remover = array("", "", "", "", "");
        return str_replace($procurar, $remover, $string);
    }

    //Remove acentos de strings.
    function removerAcentosUP($string = null, $qtdString = null)
    {
        $procurar = array("À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï", "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "ü", "Ý", "Þ", "ß", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ý", "ý", "þ", "ÿ", "R", "r", " ", "!", "@", "#", "$", "%", "&", "*", "(", ")", "_", "+", "=", "{", "[", "}", "]", "?", ";", ":", ".", ",", "'.\.'", ",", "'", "<", ">", "°", "º", "ª", '"', "/");
        $remover = array("A", "A", "A", "A", "A", "A", "A", "C", "C", "E", "E", "E", "I", "I", "I", "I", "D", "N", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "u", "Y", "B", "S", "a", "a", "a", "a", "a", "a", "a", "c", "e", "e", "e", "e", "i", "i", "i", "i", "o", "n", "o", "o", "o", "o", "o", "o", "u", "u", "u", "y", "y", "b", "y", "R", "r", " ", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");

        if ($qtdString) {


            return  substr(strtoupper(str_replace($procurar, $remover, $string)), 0, $qtdString);;
        } else {

            return strtoupper(str_replace($procurar, $remover, $string));
        }
    }

    //Remove acentos de strings, exceto os mais usados no pt-br
    function phpspecialchars_escape($string = null)
    {
        $procurar = array("Ä", "Å", "Æ", "Ç", "Ë", "Î", "Ï", "Ð", "Ñ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "ü", "Ý", "Þ", "ß", "ä", "å", "æ", "ë", "ì", "í", "î", "ï", "ñ", "ö", "ø", "ù", "ú", "û", "ý", "ý", "þ", "ÿ", "R", "r", " ", "@", "#", "$", "%", "&", "*", "(", ")", "_", "+", "=", "{", "[", "}", "]", ";", "'.\.'", "'", "<", ">", "°", "º", "ª", '"', "/");
        $remover = array("A", "A", "A", "C", "C", "I", "I", "D", "N", "O", "O", "U", "U", "U", "U", "u", "Y", "B", "S", "a", "a", "a", "e", "i", "i", "i", "i", "n", "o", "o", "u", "u", "u", "y", "y", "b", "y", "R", "r", " ", "", "", "-cifrao-", "-porcento-", "", "", "", "", "", "-mais-", "", "", "", "", "", "",  "", "", "", "", "", "", "", "", "");
        return str_replace($procurar, $remover, $string);
    }


    //Remove acentos de strings, exceto os mais usados no pt-br
    function phpspecialchars_escape2($string = null)
    {
        $procurar = array("Ä", "Å", "Æ", "Ç", "Ë", "Î", "Ï", "Ð", "Ñ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "ü", "Ý", "Þ", "ß", "ä", "å", "æ", "ë", "ì", "í", "î", "ï", "ñ", "ö", "ø", "ù", "ú", "û", "ý", "ý", "þ", "ÿ", "R", "r", "&", "'.\.'", "'", "<", ">", "°", "º", "ª", '"', "/");
        $remover = array("A", "A", "A", "C", "C", "I", "I", "D", "N", "O", "O", "U", "U", "U", "U", "u", "Y", "B", "S", "a", "a", "a", "e", "i", "i", "i", "i", "n", "o", "o", "u", "u", "u", "y", "y", "b", "y", "R", "r", "", "", "", "", "", "", "", "", "", "", "");
        return str_replace($procurar, $remover, $string);
    }

    //Moeda
    function moedaReal($valor = null, $real = false)
    {

        if ($valor) {
            $valor = ($real == TRUE ? 'R$ ' : '') . number_format($valor, 2, ",", ".");
            return $valor;
        }
    }

    //Moeda
    public function formatoDecimal($valor = null)
    {
        if ($valor) {
            $valor = str_replace('.', ',', $valor);
            $valor = str_replace(',', '.', $valor);
            return $valor;
        }
    }


    /**
     * @param $str
     *
     * @return null|string|string[]
     */
    public static function onlyNumbers($str)
    {
        $str = preg_replace('/\D/', '', $str);
        return $str;
    }


    /**
     * @param $str
     * @return string
     */
    public static function formatMoneyDb($str)
    {
        $str = number_format((self::onlyNumbers($str) / 100), 2);
        $str = str_replace(',', '', $str);
        return $str;
    }


    //Unique ID, numero de referencia
    function uniqidReal($lenght)
    {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }

    //Remove caracteres de stings numericas, e valida para que permita apenas valores numericos strings.
    function limparString($string = null)
    {
        if ($string) {
            return preg_replace("/[^0-9\.,s+]/", "", $string);
        }
    }

    //Remove caracteres de stings numericas, e valida para que permita apenas valores numericos no formato americano e brasileiro.
    function limparMoeda($string = null)
    {
        if ($string) {
            return preg_replace("/[^\d\.,]/", "", $string);
        }
    }

    //Remove caracteres de datas, e valida para que permita apenas valores numericos hifen(-).
    function limparData($string = null)
    {
        if ($string) {
            return preg_replace("/[^\d\-\/]/", "", $string);
        }
    }

    //Remove caracteres de datas, e valida para que permita apenas valores numericos hifen(-).
    function limparTelefone($string = null)
    {
        if ($string) {
            return preg_replace("/[^\d\()-\/]/", "", $string);
        }
    }

    function sanitize_phone($phone, $international = true)
    {
        $format = "/(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/";

        $alt_format = '/^(\+\s*)?((0{0,2}1{1,3}[^\d]+)?\(?\s*([2-9][0-9]{2})\s*[^\d]?\s*([2-9][0-9]{2})\s*[^\d]?\s*([\d]{4})){1}(\s*([[:alpha:]#][^\d]*\d.*))?$/';

        // Trim & Clean extension
        $phone = trim($phone);
        $phone = preg_replace('/\s+(#|x|ext(ension)?)\.?:?\s*(\d+)/', ' ext \3', $phone);

        if (preg_match($alt_format, $phone, $matches)) {
            return '(' . $matches[4] . ') ' . $matches[5] . '-' . $matches[6] . (!empty($matches[8]) ? ' ' . $matches[8] : '');
        } elseif (preg_match($format, $phone, $matches)) {

            // format
            $phone = preg_replace($alt_format, "($2) $3-$4", $phone);

            // Remove likely has a preceding dash
            $phone = ltrim($phone, '-');

            // Remove empty area codes
            if (false !== strpos(trim($phone), '()', 0)) {
                $phone = ltrim(trim($phone), '()');
            }

            // Trim and remove double spaces created
            return preg_replace('/\\s+/', ' ', trim($phone));
        }

        return false;
    }



    function ocultarEmail($string = null)
    {
        if ($string) {
            //oculta o nome de usuario
            // $string = preg_replace('/(?<=@.)[a-zA-Z0-9-]*(?=(?:[.]|$))/', '*', $string);
            $string = preg_replace('/(?<=...).(?=.*@)/', '*', $string);
            //oculta o dominio
            return preg_replace('/(?<=@.)[a-zA-Z0-9-]*(?=(?:[.]|$))/', '*', $string);
        }
    }

    function ocultarString($string = null, $limit)
    {
        if ($string) {
            $str = strrev(preg_replace('/\d/', '*',  strrev($string), $limit));
        }

        return $str;
    }

    function limparEmail($string = null)
    {
        if ($string) {
            $string = preg_replace('/(\S+)@(\S+)\.(\S+)/', '<a href="mailto:\\1@\\2.\\3">\\1@\\2.\\3</a>', $string);

            return preg_replace('=([^\s]*)([url]www.[/url])([^\s]*)=', '<a href="http://\\2\\3" target=\'_blank\'>[url]http://\\2\\3[/url]</a>', $string);
        }
    }

    function htmlspecialchars_recursive($input, $flags = ENT_COMPAT | ENT_HTML401, $encoding = 'UTF-8', $double_encode = false)
    {
        static $flags, $encoding, $double_encode;
        if (is_array($input)) {
            return array_map('htmlspecialchars_recursive', $input);
        } else if (is_scalar($input)) {
            return htmlspecialchars($input, $flags, $encoding, $double_encode);
        } else {
            return $input;
        }
    }

    public function valEmail($Email)
    {
        $this->Dados = (string) $Email;
        $this->Formato = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if (preg_match($this->Formato, $this->Dados)) {
            return true;
        } else {
            //$_SESSION['msg'] = "<div class='alert alert-danger'>Erro: E-mail inválido!</div>";
            return false;
        }
    }

    function validaDocument($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += $cpf[$i] * (10 - $i);
        }
        $resto = $soma % 11;
        $dv1 = ($resto < 2) ? 0 : (11 - $resto);

        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += $cpf[$i] * (11 - $i);
        }
        $resto = $soma % 11;
        $dv2 = ($resto < 2) ? 0 : (11 - $resto);

        if ($cpf[9] != $dv1 || $cpf[10] != $dv2) {
            return false;
        }

        return true;
    }
}
