<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bool new_value
 * @return ChannelAdminLogEventAction
 */

final class ChannelAdminLogEventActionToggleSignatureProfiles extends Instance {
	public function request(bool $new_value) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x60a79c79);
		$writer->tgwriteBool($new_value);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['new_value'] = $reader->tgreadBool();
		return new self($result);
	}
}

?>