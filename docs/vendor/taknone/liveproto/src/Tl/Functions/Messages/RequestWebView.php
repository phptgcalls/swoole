<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputuser bot string platform true from_bot_menu true silent true compact true fullscreen string url string start_param datajson theme_params inputreplyto reply_to inputpeer send_as
 * @return WebViewResult
 */

final class RequestWebView extends Instance {
	public function request(object $peer,object $bot,string $platform,? true $from_bot_menu = null,? true $silent = null,? true $compact = null,? true $fullscreen = null,? string $url = null,? string $start_param = null,? object $theme_params = null,? object $reply_to = null,? object $send_as = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x269dc2c1);
		$flags = 0;
		$flags |= is_null($from_bot_menu) ? 0 : (1 << 4);
		$flags |= is_null($silent) ? 0 : (1 << 5);
		$flags |= is_null($compact) ? 0 : (1 << 7);
		$flags |= is_null($fullscreen) ? 0 : (1 << 8);
		$flags |= is_null($url) ? 0 : (1 << 1);
		$flags |= is_null($start_param) ? 0 : (1 << 3);
		$flags |= is_null($theme_params) ? 0 : (1 << 2);
		$flags |= is_null($reply_to) ? 0 : (1 << 0);
		$flags |= is_null($send_as) ? 0 : (1 << 13);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->write($bot->read());
		if(is_null($url) === false):
			$writer->tgwriteBytes($url);
		endif;
		if(is_null($start_param) === false):
			$writer->tgwriteBytes($start_param);
		endif;
		if(is_null($theme_params) === false):
			$writer->write($theme_params->read());
		endif;
		$writer->tgwriteBytes($platform);
		if(is_null($reply_to) === false):
			$writer->write($reply_to->read());
		endif;
		if(is_null($send_as) === false):
			$writer->write($send_as->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>