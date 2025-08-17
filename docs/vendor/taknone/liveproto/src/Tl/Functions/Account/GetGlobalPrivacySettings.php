<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return GlobalPrivacySettings
 */

final class GetGlobalPrivacySettings extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xeb2b4cf6);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>