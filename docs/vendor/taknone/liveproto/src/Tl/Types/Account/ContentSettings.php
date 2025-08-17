<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true sensitive_enabled true sensitive_can_change
 * @return account.ContentSettings
 */

final class ContentSettings extends Instance {
	public function request(? true $sensitive_enabled = null,? true $sensitive_can_change = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x57e28221);
		$flags = 0;
		$flags |= is_null($sensitive_enabled) ? 0 : (1 << 0);
		$flags |= is_null($sensitive_can_change) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['sensitive_enabled'] = true;
		else:
			$result['sensitive_enabled'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['sensitive_can_change'] = true;
		else:
			$result['sensitive_can_change'] = false;
		endif;
		return new self($result);
	}
}

?>