<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string first_name string last_name string about
 * @return User
 */

final class UpdateProfile extends Instance {
	public function request(? string $first_name = null,? string $last_name = null,? string $about = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x78515775);
		$flags = 0;
		$flags |= is_null($first_name) ? 0 : (1 << 0);
		$flags |= is_null($last_name) ? 0 : (1 << 1);
		$flags |= is_null($about) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($first_name) === false):
			$writer->tgwriteBytes($first_name);
		endif;
		if(is_null($last_name) === false):
			$writer->tgwriteBytes($last_name);
		endif;
		if(is_null($about) === false):
			$writer->tgwriteBytes($about);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>