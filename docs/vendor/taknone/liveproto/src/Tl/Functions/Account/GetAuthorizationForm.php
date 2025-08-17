<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long bot_id string scope string public_key
 * @return account.AuthorizationForm
 */

final class GetAuthorizationForm extends Instance {
	public function request(int $bot_id,string $scope,string $public_key) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa929597a);
		$writer->writeLong($bot_id);
		$writer->tgwriteBytes($scope);
		$writer->tgwriteBytes($public_key);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>