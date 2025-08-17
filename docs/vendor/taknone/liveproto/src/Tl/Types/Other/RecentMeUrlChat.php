<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url long chat_id
 * @return RecentMeUrl
 */

final class RecentMeUrlChat extends Instance {
	public function request(string $url,int $chat_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb2da71d2);
		$writer->tgwriteBytes($url);
		$writer->writeLong($chat_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		$result['chat_id'] = $reader->readLong();
		return new self($result);
	}
}

?>