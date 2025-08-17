<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputcheckpasswordsrp password account new_settings
 * @return Bool
 */

final class UpdatePasswordSettings extends Instance {
	public function request(object $password,object $new_settings) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa59b102f);
		$writer->write($password->read());
		$writer->write($new_settings->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>