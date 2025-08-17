<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<RichText> texts
 * @return RichText
 */

final class TextConcat extends Instance {
	public function request(array $texts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7e6260d7);
		$writer->tgwriteVector($texts,'RichText');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['texts'] = $reader->tgreadVector('RichText');
		return new self($result);
	}
}

?>