<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string lang_code
 * @return EmojiLanguage
 */

final class EmojiLanguage extends Instance {
	public function request(string $lang_code) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb3fb5361);
		$writer->tgwriteBytes($lang_code);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['lang_code'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>