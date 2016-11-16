  <?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        $config['charset'] = 'utf-8';
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.mailgun.org';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'postmaster@app79725467bb7b41e8949b65d4c2779a21.mailgun.org';
        $config['smtp_pass'] = 'a606278137fbbeb3f49db320b0a62e70';
        $config['smtp_timeout'] = '4';
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE;