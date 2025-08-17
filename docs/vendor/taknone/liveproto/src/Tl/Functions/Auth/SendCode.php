<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number int api_id string api_hash codesettings settings
 * @return auth.SentCode
 */

final class SendCode extends Instance {
	public function request(string $phone_number,int $api_id,string $api_hash,object $settings) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa677244f);
		$writer->tgwriteBytes($phone_number);
		$writer->writeInt($api_id);
		$writer->tgwriteBytes($api_hash);
		$writer->write($settings->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>