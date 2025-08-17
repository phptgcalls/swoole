<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long nonce long temp_auth_key_id long perm_auth_key_id long temp_session_id int expires_at
 * @return BindAuthKeyInner
 */

final class BindAuthKeyInner extends Instance {
	public function request(int $nonce,int $temp_auth_key_id,int $perm_auth_key_id,int $temp_session_id,int $expires_at) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x75a3f765);
		$writer->writeLong($nonce);
		$writer->writeLong($temp_auth_key_id);
		$writer->writeLong($perm_auth_key_id);
		$writer->writeLong($temp_session_id);
		$writer->writeInt($expires_at);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['nonce'] = $reader->readLong();
		$result['temp_auth_key_id'] = $reader->readLong();
		$result['perm_auth_key_id'] = $reader->readLong();
		$result['temp_session_id'] = $reader->readLong();
		$result['expires_at'] = $reader->readInt();
		return new self($result);
	}
}

?>