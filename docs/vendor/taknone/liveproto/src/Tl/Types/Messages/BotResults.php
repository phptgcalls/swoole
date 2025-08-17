<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long query_id Vector<BotInlineResult> results int cache_time Vector<User> users true gallery string next_offset inlinebotswitchpm switch_pm inlinebotwebview switch_webview
 * @return messages.BotResults
 */

final class BotResults extends Instance {
	public function request(int $query_id,array $results,int $cache_time,array $users,? true $gallery = null,? string $next_offset = null,? object $switch_pm = null,? object $switch_webview = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe021f2f6);
		$flags = 0;
		$flags |= is_null($gallery) ? 0 : (1 << 0);
		$flags |= is_null($next_offset) ? 0 : (1 << 1);
		$flags |= is_null($switch_pm) ? 0 : (1 << 2);
		$flags |= is_null($switch_webview) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->writeLong($query_id);
		if(is_null($next_offset) === false):
			$writer->tgwriteBytes($next_offset);
		endif;
		if(is_null($switch_pm) === false):
			$writer->write($switch_pm->read());
		endif;
		if(is_null($switch_webview) === false):
			$writer->write($switch_webview->read());
		endif;
		$writer->tgwriteVector($results,'BotInlineResult');
		$writer->writeInt($cache_time);
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['gallery'] = true;
		else:
			$result['gallery'] = false;
		endif;
		$result['query_id'] = $reader->readLong();
		if($flags & (1 << 1)):
			$result['next_offset'] = $reader->tgreadBytes();
		else:
			$result['next_offset'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['switch_pm'] = $reader->tgreadObject();
		else:
			$result['switch_pm'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['switch_webview'] = $reader->tgreadObject();
		else:
			$result['switch_webview'] = null;
		endif;
		$result['results'] = $reader->tgreadVector('BotInlineResult');
		$result['cache_time'] = $reader->readInt();
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>