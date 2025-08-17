<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long bot_id string scope string public_key Vector<SecureValueHash> value_hashes securecredentialsencrypted credentials
 * @return Bool
 */

final class AcceptAuthorization extends Instance {
	public function request(int $bot_id,string $scope,string $public_key,array $value_hashes,object $credentials) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf3ed4c73);
		$writer->writeLong($bot_id);
		$writer->tgwriteBytes($scope);
		$writer->tgwriteBytes($public_key);
		$writer->tgwriteVector($value_hashes,'SecureValueHash');
		$writer->write($credentials->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>