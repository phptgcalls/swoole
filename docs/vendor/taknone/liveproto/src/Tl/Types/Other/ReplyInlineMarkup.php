<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<KeyboardButtonRow> rows
 * @return ReplyMarkup
 */

final class ReplyInlineMarkup extends Instance {
	public function request(array $rows) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x48a30254);
		$writer->tgwriteVector($rows,'KeyboardButtonRow');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['rows'] = $reader->tgreadVector('KeyboardButtonRow');
		return new self($result);
	}
}

?>