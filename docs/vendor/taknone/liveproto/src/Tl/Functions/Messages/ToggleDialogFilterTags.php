<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bool enabled
 * @return Bool
 */

final class ToggleDialogFilterTags extends Instance {
	public function request(bool $enabled) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfd2dda49);
		$writer->tgwriteBool($enabled);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>