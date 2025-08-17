<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string lang_code
 * @return EmojiKeywordsDifference
 */

final class GetEmojiKeywords extends Instance {
	public function request(string $lang_code) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x35a0e062);
		$writer->tgwriteBytes($lang_code);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>