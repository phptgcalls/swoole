<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int token_type string token bool app_sandbox bytes secret Vector<long> other_uids true no_muted
 * @return Bool
 */

final class RegisterDevice extends Instance {
	public function request(int $token_type,string $token,bool $app_sandbox,string $secret,array $other_uids,? true $no_muted = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xec86017a);
		$flags = 0;
		$flags |= is_null($no_muted) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($token_type);
		$writer->tgwriteBytes($token);
		$writer->tgwriteBool($app_sandbox);
		$writer->tgwriteBytes($secret);
		$writer->tgwriteVector($other_uids,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>