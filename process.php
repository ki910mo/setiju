<?php
require_once "Mail.php";

// メールの文字セット
define( "MAIL_CHARSET", "ISO-2022-JP" );


// smtpサーバ接続情報
$param = array(
	"host" => "smtp.gmail.com"
	, "port" => 587
	, "auth" => true
	, "username" => "ki910mo@gmail.com"
	, "password" => "ki910mo3ki910mo3"
);

// 送信先情報
$to = array( "info@setiju.com" );

// 送信元＆件名＆本文を用意し、エンコード
$from = $_REQUEST['name'];
$from = mb_encode_mimeheader( $from, MAIL_CHARSET );
$subject = $_REQUEST['subject'];
$subject = mb_encode_mimeheader( $subject, MAIL_CHARSET );
$body = mb_convert_encoding( $body, MAIL_CHARSET, "UTF-8" );

// メールヘッダ
$header = array(
	"From" => $from
	, "To" => implode( ",", $to )
	, "Subject" => $subject
	, "Content-Type" => "text/plain; charset=" . MAIL_CHARSET
);

// PEAR::Mailオブジェクト取得
$obj =& Mail::factory( "smtp", $param );

// メール送信
$ret = $obj->send( $to, $header, $body );
if ( PEAR::isError( $ret ) ) {
	echo "Code[" . $ret->getCode() . "], Msg[" . $ret->getMessage() . "]\n";
} else {
	echo true;
}

?>