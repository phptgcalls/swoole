<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int cache_time true alert true has_url true native_ui string message string url
 * @return messages.BotCallbackAnswer
 */

final class BotCallbackAnswer extends Instance {
	public function request(int $cache_time,? true $alert = null,? true $has_url = null,? true $native_ui = null,? string $message = null,? string $url = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x36585ea4);
		$flags = 0;
		$flags |= is_null($alert) ? 0 : (1 << 1);
		$flags |= is_null($has_url) ? 0 : (1 << 3);
		$flags |= is_null($native_ui) ? 0 : (1 << 4);
		$flags |= is_null($message) ? 0 : (1 << 0);
		$flags |= is_null($url) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($message) === false):
			$writer->tgwriteBytes($message);
		endif;
		if(is_null($url) === false):
			$writer->tgwriteBytes($url);
		endif;
		$writer->writeInt($cache_time);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['alert'] = true;
		else:
			$result['alert'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['has_url'] = true;
		else:
			$result['has_url'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['native_ui'] = true;
		else:
			$result['native_ui'] = false;
		endif;
		if($flags & (1 << 0)):
			$result['message'] = $reader->tgreadBytes();
		else:
			$result['message'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['url'] = $reader->tgreadBytes();
		else:
			$result['url'] = null;
		endif;
		$result['cache_time'] = $reader->readInt();
		return new self($result);
	}
}

?>