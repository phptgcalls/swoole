<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int api_id string device_model string system_version string app_version string system_lang_code string lang_pack string lang_code x query inputclientproxy proxy jsonvalue params
 * @return X
 */

final class InitConnection extends Instance {
	public function request(int $api_id,string $device_model,string $system_version,string $app_version,string $system_lang_code,string $lang_pack,string $lang_code,object $query,? object $proxy = null,? object $params = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc1cd5ea9);
		$flags = 0;
		$flags |= is_null($proxy) ? 0 : (1 << 0);
		$flags |= is_null($params) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeInt($api_id);
		$writer->tgwriteBytes($device_model);
		$writer->tgwriteBytes($system_version);
		$writer->tgwriteBytes($app_version);
		$writer->tgwriteBytes($system_lang_code);
		$writer->tgwriteBytes($lang_pack);
		$writer->tgwriteBytes($lang_code);
		if(is_null($proxy) === false):
			$writer->write($proxy->read());
		endif;
		if(is_null($params) === false):
			$writer->write($params->read());
		endif;
		$writer->write($query->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>