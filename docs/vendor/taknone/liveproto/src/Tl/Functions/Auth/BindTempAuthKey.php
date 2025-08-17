<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long perm_auth_key_id long nonce int expires_at bytes encrypted_message
 * @return Bool
 */

final class BindTempAuthKey extends Instance {
	public function request(int $perm_auth_key_id,int $nonce,int $expires_at,string $encrypted_message) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcdd42a05);
		$writer->writeLong($perm_auth_key_id);
		$writer->writeLong($nonce);
		$writer->writeInt($expires_at);
		$writer->tgwriteBytes($encrypted_message);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>