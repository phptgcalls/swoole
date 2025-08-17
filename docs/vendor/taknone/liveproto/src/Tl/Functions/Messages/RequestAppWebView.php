<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputbotapp app string platform true write_allowed true compact true fullscreen string start_param datajson theme_params
 * @return WebViewResult
 */

final class RequestAppWebView extends Instance {
	public function request(object $peer,object $app,string $platform,? true $write_allowed = null,? true $compact = null,? true $fullscreen = null,? string $start_param = null,? object $theme_params = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x53618bce);
		$flags = 0;
		$flags |= is_null($write_allowed) ? 0 : (1 << 0);
		$flags |= is_null($compact) ? 0 : (1 << 7);
		$flags |= is_null($fullscreen) ? 0 : (1 << 8);
		$flags |= is_null($start_param) ? 0 : (1 << 1);
		$flags |= is_null($theme_params) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->write($app->read());
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