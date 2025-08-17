<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot string platform true from_switch_webview true from_side_menu true compact true fullscreen string url string start_param datajson theme_params
 * @return WebViewResult
 */

final class RequestSimpleWebView extends Instance {
	public function request(object $bot,string $platform,? true $from_switch_webview = null,? true $from_side_menu = null,? true $compact = null,? true $fullscreen = null,? string $url = null,? string $start_param = null,? object $theme_params = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x413a3e73);
		$flags = 0;
		$flags |= is_null($from_switch_webview) ? 0 : (1 << 1);
		$flags |= is_null($from_side_menu) ? 0 : (1 << 2);
		$flags |= is_null($compact) ? 0 : (1 << 7);
		$flags |= is_null($fullscreen) ? 0 : (1 << 8);
		$flags |= is_null($url) ? 0 : (1 << 3);
		$flags |= is_null($start_param) ? 0 : (1 << 4);
		$flags |= is_null($theme_params) ? 0 : (1 << 0);
		$writer->writeInt($flags);
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
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>