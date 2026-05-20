<?php

class Conexao {

    public static $url;
    public static $key;

    public static function inicializar() {
        // Carrega variáveis do arquivo .env (um nível acima de config/)
        $envFile = __DIR__ . '/../.env';

        if (file_exists($envFile)) {
            $linhas = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($linhas as $linha) {
                if (str_starts_with(trim($linha), '#')) continue;
                [$chave, $valor] = explode('=', $linha, 2);
                $_ENV[trim($chave)] = trim($valor);
            }
        }

        self::$url = $_ENV['SUPABASE_URL'] ?? '';
        self::$key = $_ENV['SUPABASE_KEY'] ?? '';

        if (!self::$url || !self::$key) {
            die('Erro: variáveis SUPABASE_URL e SUPABASE_KEY não configuradas. Crie o arquivo .env a partir do .env.example.');
        }
    }

    public static function requisicao($metodo, $tabela, $dados = null, $filtro = '') {

        // Garante inicialização automática caso não tenha sido chamada
        if (!self::$url) {
            self::inicializar();
        }

        $endpoint = self::$url . '/rest/v1/' . $tabela;

        if ($filtro) {
            $endpoint .= '?' . $filtro;
        }

        $ch = curl_init($endpoint);

        $cabecalhos = [
            'apikey: ' . self::$key,
            'Authorization: Bearer ' . self::$key,
            'Content-Type: application/json',
            'Prefer: return=representation'
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecalhos);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($metodo === 'GET') {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
        }

        if ($metodo === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
        }

        if ($metodo === 'PATCH') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
        }

        if ($metodo === 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }

        $resposta = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // DELETE retorna 204 (sem corpo) — trata como sucesso
        if ($metodo === 'DELETE') {
            return ($httpCode >= 200 && $httpCode < 300) ? [] : null;
        }

        if ($resposta === false || $httpCode >= 400) {
            return null;
        }

        $decoded = json_decode($resposta, true);

        // POST/PATCH com Prefer:return=representation retorna array
        // GET também retorna array
        if ($decoded === null && $httpCode >= 200 && $httpCode < 300) {
            return [];
        }

        return $decoded;
    }
}
