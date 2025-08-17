<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number codesettings settings
 * @return auth.SentCode
 */

final class SendVerifyPhoneCode extends Instance {
	public function request(string $phone_number,object $settings) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa5a356f9);
		$writer->tgwriteBytes($phone_number);
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