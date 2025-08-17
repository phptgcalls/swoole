<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param securepasswordkdfalgo secure_algo bytes secure_secret long secure_secret_id
 * @return SecureSecretSettings
 */

final class SecureSecretSettings extends Instance {
	public function request(object $secure_algo,string $secure_secret,int $secure_secret_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1527bcac);
		$writer->write($secure_algo->read());
		$writer->tgwriteBytes($secure_secret);
		$writer->writeLong($secure_secret_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['secure_algo'] = $reader->tgreadObject();
		$result['secure_secret'] = $reader->tgreadBytes();
		$result['secure_secret_id'] = $reader->readLong();
		return new self($result);
	}
}

?>