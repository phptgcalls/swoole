<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id Vector<InputBotInlineResult> results int cache_time true gallery true private string next_offset inlinebotswitchpm switch_pm inlinebotwebview switch_webview
 * @return Bool
 */

final class SetInlineBotResults extends Instance {
	public function request(int $query_id,array $results,int $cache_time,? true $gallery = null,? true $private = null,? string $next_offset = null,? object $switch_pm = null,? object $switch_webview = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbb12a419);
		$flags = 0;
		$flags |= is_null($gallery) ? 0 : (1 << 0);
		$flags |= is_null($private) ? 0 : (1 << 1);
		$flags |= is_null($next_offset) ? 0 : (1 << 2);
		$flags |= is_null($switch_pm) ? 0 : (1 << 3);
		$flags |= is_null($switch_webview) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->writeLong($query_id);
		$writer->tgwriteVector($results,'InputBotInlineResult');
		$writer->writeInt($cache_time);
		if(is_null($next_offset) === false):
			$writer->tgwriteBytes($next_offset);
		endif;
		if(is_null($switch_pm) === false):
			$writer->write($switch_pm->read());
		endif;
		if(is_null($switch_webview) === false):
			$writer->write($switch_webview->read());
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