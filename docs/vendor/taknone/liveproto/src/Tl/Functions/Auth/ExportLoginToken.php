<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int api_id string api_hash Vector<long> except_ids
 * @return auth.LoginToken
 */

final class ExportLoginToken extends Instance {
	public function request(int $api_id,string $api_hash,array $except_ids) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb7e085fe);
		$writer->writeInt($api_id);
		$writer->tgwriteBytes($api_hash);
		$writer->tgwriteVector($except_ids,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>