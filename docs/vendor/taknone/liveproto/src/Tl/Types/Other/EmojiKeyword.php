<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string keyword Vector<string> emoticons
 * @return EmojiKeyword
 */

final class EmojiKeyword extends Instance {
	public function request(string $keyword,array $emoticons) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd5b3b9f9);
		$writer->tgwriteBytes($keyword);
		$writer->tgwriteVector($emoticons,'string');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['keyword'] = $reader->tgreadBytes();
		$result['emoticons'] = $reader->tgreadVector('string');
		return new self($result);
	}
}

?>