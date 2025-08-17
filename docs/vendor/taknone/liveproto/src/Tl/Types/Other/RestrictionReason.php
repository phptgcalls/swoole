<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string platform string reason string text
 * @return RestrictionReason
 */

final class RestrictionReason extends Instance {
	public function request(string $platform,string $reason,string $text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd072acb4);
		$writer->tgwriteBytes($platform);
		$writer->tgwriteBytes($reason);
		$writer->tgwriteBytes($text);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['platform'] = $reader->tgreadBytes();
		$result['reason'] = $reader->tgreadBytes();
		$result['text'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>