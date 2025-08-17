<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<KeyboardButtonRow> rows true resize true single_use true selective true persistent string placeholder
 * @return ReplyMarkup
 */

final class ReplyKeyboardMarkup extends Instance {
	public function request(array $rows,? true $resize = null,? true $single_use = null,? true $selective = null,? true $persistent = null,? string $placeholder = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x85dd99d1);
		$flags = 0;
		$flags |= is_null($resize) ? 0 : (1 << 0);
		$flags |= is_null($single_use) ? 0 : (1 << 1);
		$flags |= is_null($selective) ? 0 : (1 << 2);
		$flags |= is_null($persistent) ? 0 : (1 << 4);
		$flags |= is_null($placeholder) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->tgwriteVector($rows,'KeyboardButtonRow');
		if(is_null($placeholder) === false):
			$writer->tgwriteBytes($placeholder);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['resize'] = true;
		else:
			$result['resize'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['single_use'] = true;
		else:
			$result['single_use'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['selective'] = true;
		else:
			$result['selective'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['persistent'] = true;
		else:
			$result['persistent'] = false;
		endif;
		$result['rows'] = $reader->tgreadVector('KeyboardButtonRow');
		if($flags & (1 << 3)):
			$result['placeholder'] = $reader->tgreadBytes();
		else:
			$result['placeholder'] = null;
		endif;
		return new self($result);
	}
}

?>