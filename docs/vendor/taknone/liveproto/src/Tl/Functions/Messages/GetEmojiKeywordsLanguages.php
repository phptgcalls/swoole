<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<string> lang_codes
 * @return Vector<EmojiLanguage>
 */

final class GetEmojiKeywordsLanguages extends Instance {
	public function request(array $lang_codes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4e9963b2);
		$writer->tgwriteVector($lang_codes,'string');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>