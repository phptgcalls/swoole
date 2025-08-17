<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param botapp app true inactive true request_write_access true has_settings
 * @return messages.BotApp
 */

final class BotApp extends Instance {
	public function request(object $app,? true $inactive = null,? true $request_write_access = null,? true $has_settings = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xeb50adf5);
		$flags = 0;
		$flags |= is_null($inactive) ? 0 : (1 << 0);
		$flags |= is_null($request_write_access) ? 0 : (1 << 1);
		$flags |= is_null($has_settings) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($app->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['inactive'] = true;
		else:
			$result['inactive'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['request_write_access'] = true;
		else:
			$result['request_write_access'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['has_settings'] = true;
		else:
			$result['has_settings'] = false;
		endif;
		$result['app'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>