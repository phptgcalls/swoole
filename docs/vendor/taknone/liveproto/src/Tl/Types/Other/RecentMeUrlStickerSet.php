<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url stickersetcovered set
 * @return RecentMeUrl
 */

final class RecentMeUrlStickerSet extends Instance {
	public function request(string $url,object $set) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbc0a57dc);
		$writer->tgwriteBytes($url);
		$writer->write($set->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		$result['set'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>