<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<TextWithEntities> result
 * @return messages.TranslatedText
 */

final class TranslateResult extends Instance {
	public function request(array $result) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x33db32f8);
		$writer->tgwriteVector($result,'TextWithEntities');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadVector('TextWithEntities');
		return new self($result);
	}
}

?>