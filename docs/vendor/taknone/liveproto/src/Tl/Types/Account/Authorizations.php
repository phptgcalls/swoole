<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int authorization_ttl_days Vector<Authorization> authorizations
 * @return account.Authorizations
 */

final class Authorizations extends Instance {
	public function request(int $authorization_ttl_days,array $authorizations) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4bff8ea0);
		$writer->writeInt($authorization_ttl_days);
		$writer->tgwriteVector($authorizations,'Authorization');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['authorization_ttl_days'] = $reader->readInt();
		$result['authorizations'] = $reader->tgreadVector('Authorization');
		return new self($result);
	}
}

?>