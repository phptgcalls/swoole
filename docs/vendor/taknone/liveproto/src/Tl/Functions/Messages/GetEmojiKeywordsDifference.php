<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string lang_code int from_version
 * @return EmojiKeywordsDifference
 */

final class GetEmojiKeywordsDifference extends Instance {
	public function request(string $lang_code,int $from_version) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1508b6af);
		$writer->tgwriteBytes($lang_code);
		$writer->writeInt($from_version);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>