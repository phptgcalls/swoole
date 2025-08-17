<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash true confirmed bool encrypted_requests_disabled bool call_requests_disabled
 * @return Bool
 */

final class ChangeAuthorizationSettings extends Instance {
	public function request(int $hash,? true $confirmed = null,? bool $encrypted_requests_disabled = null,? bool $call_requests_disabled = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x40f48462);
		$flags = 0;
		$flags |= is_null($confirmed) ? 0 : (1 << 3);
		$flags |= is_null($encrypted_requests_disabled) ? 0 : (1 << 0);
		$flags |= is_null($call_requests_disabled) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($hash);
		if(is_null($encrypted_requests_disabled) === false):
			$writer->tgwriteBool($encrypted_requests_disabled);
		endif;
		if(is_null($call_requests_disabled) === false):
			$writer->tgwriteBool($call_requests_disabled);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>